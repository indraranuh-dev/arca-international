<?php

namespace App\Http\Livewire\Invoice;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Invoice\Entities\Invoice;

class Table extends Component
{
    use WithPagination;

    public $deleteID, $keyword = '';

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function find($id)
    {
        $this->emitTo('invoice.create-or-edit', 'getID', $id);
    }

    public function getAll($keyword)
    {
        $invoice = Invoice::orderBy('created_at', 'desc');

        if (auth()->user()->getRoleNames()->first() === 'user') {
            $invoice->where('user_id', auth()->user()->id);
        }

        return $invoice->simplePaginate(10);
    }

    public function destroy()
    {
        $invoice = Invoice::findOrFail($this->deleteID);

        if ($invoice->status === 'pending') {
            $invoice->delete();
            $this->dispatchBrowserEvent('deleted', 'Invoice berhasil dihapus !');
            $this->reset('deleteID');
        } else {
            $this->dispatchBrowserEvent('delete-failed', 'Invoice tidak dapat dihapus ! Invoice berstatus selain pending.');
            $this->reset('deleteID');
        }

    }

    public function previewInvoice($id)
    {
        $this->emitTo('invoice.preview', 'findInvoice', $id);
    }

    public function render()
    {
        return view('livewire.invoice.table', [
            'invoices' => $this->getAll($this->keyword),
        ]);
    }
}