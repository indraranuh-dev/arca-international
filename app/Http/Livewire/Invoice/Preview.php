<?php

namespace App\Http\Livewire\Invoice;

use Livewire\Component;
use Modules\Invoice\Entities\Invoice;

class Preview extends Component
{
    public $invoice;

    protected $listeners = [
        'findInvoice',
    ];

    public function findInvoice($id)
    {
        $invoice = Invoice::where('id', $id)->with('details')->first();
        if ($invoice) {
            return $this->invoice = $invoice;
        }
        return $this->invoice = null;
    }

    public function render()
    {
        return view('livewire.invoice.preview');
    }
}