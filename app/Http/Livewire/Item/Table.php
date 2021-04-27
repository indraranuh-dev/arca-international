<?php

namespace App\Http\Livewire\Item;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Item\Entities\Item;

class Table extends Component
{
    use WithPagination;

    public $deleteID, $keyword = '';

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function find($id)
    {
        $this->emitTo('item.create-or-edit', 'getID', $id);
    }

    public function getAll($keyword)
    {
        $item = Item::orderBy('created_at', 'desc');

        if ($keyword) {
            $item->where(function ($item) use ($keyword) {
                $item->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('price', 'like', '%' . $keyword . '%')
                    ->orWhere('qty', 'like', '%' . $keyword . '%')
                    ->orWhere('discount', 'like', '%' . $keyword . '%');
            });
        }

        return $item->simplePaginate(10);
    }

    public function destroy()
    {
        $career = Item::findOrFail($this->deleteID);
        $career->delete();

        $this->dispatchBrowserEvent('deleted', 'Item berhasil dihapus !');
        $this->reset('deleteID');
    }

    public function render()
    {
        return view('livewire.item.table', [
            'items' => $this->getAll($this->keyword),
        ]);
    }
}