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
        return $invoice->simplePaginate(10);
    }

    public function destroy()
    {
        $career = Invoice::findOrFail($this->deleteID);
        $career->delete();

        $this->dispatchBrowserEvent('deleted', 'Invoice berhasil dihapus !');
        $this->reset('deleteID');
    }

    public function render()
    {
        return view('livewire.invoice.table', [
            'invoices' => $this->getAll($this->keyword),
        ]);
    }
}