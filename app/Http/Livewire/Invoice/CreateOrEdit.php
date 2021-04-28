<?php

namespace App\Http\Livewire\Invoice;

use App\Constants\InvoiceStatus;
use App\Traits\InvoiceCode;
use Livewire\Component;
use Modules\Invoice\Entities\Invoice;

class CreateOrEdit extends Component
{
    use InvoiceCode;

    public $invoice, $invoiceCode, $userData, $status = 'pending', $dateCreated;

    protected $listeners = ['detailsCreated'];

    public function mount()
    {
        $this->invoiceCode = $this->generateInvoiceCode();
        $this->dateCreated = date('d-m-Y');
        $this->userData = auth()->user();
    }

    public function submitForm()
    {
        $invoice = new Invoice();
        $invoice->invoice_code = $this->invoiceCode;
        $invoice->user_id = $this->userData->id;
        $invoice->user_name = $this->userData->name;
        $invoice->user_email = $this->userData->email;
        $invoice->status = $this->status;
        $invoice->save();

        $this->emitTo('invoice.item-table', 'invoiceCreated', $this->invoiceCode);
    }

    public function detailsCreated()
    {
        $lang = $this->invoice ? 'diperbarui' : 'ditambahkan';
        $action = $this->invoice ? 'updated' : 'created';

        $message = 'Invoice berhasil ' . $lang . ' !';
        $this->dispatchBrowserEvent($action, $message);
        $this->emitTo('invoice.table', 'refreshTable');
        $this->reset();

        $this->invoiceCode = $this->generateInvoiceCode();
        $this->dateCreated = date('d-m-Y');
        $this->userData = auth()->user();
    }

    public function render(InvoiceStatus $invoiceStatus)
    {
        return view('livewire.invoice.create-or-edit', [
            'statuses' => $invoiceStatus->getAll(),
        ]);
    }
}