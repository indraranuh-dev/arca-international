<?php

namespace App\Http\Livewire\Item;

use Livewire\Component;
use Modules\Item\Entities\Item;

class CreateOrEdit extends Component
{
    public $item, $itemId, $name, $price = 0, $quantity = 0, $discount = 0;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:191',
            'price' => 'required|integer|min:0',
            'quantity' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
        ];
    }

    protected $listeners = [
        'getID' => 'findItem',
    ];

    public function findItem($id)
    {
        $item = Item::findOrFail($id);
        $this->item = $item;
        $this->itemId = $item->id;
        $this->name = $item->name;
        $this->price = $item->price;
        $this->quantity = $item->qty;
        $this->discount = $item->discount;
    }

    public function submitForm()
    {
        $this->validate();

        if ($this->item) {

            $item = Item::findOrFail($this->itemId);
            $item->name = $this->name;
            $item->price = $this->price;
            $item->qty = $this->quantity ? $this->quantity : 0;
            $item->discount = $this->discount ? $this->discount : 0;
            $item->save();

        } else {

            $item = new Item();
            $item->name = $this->name;
            $item->price = $this->price;
            $item->qty = $this->quantity ? $this->quantity : 0;
            $item->discount = $this->discount ? $this->discount : 0;
            $item->save();

        }

        $lang = $this->item ? 'diperbarui' : 'ditambahkan';
        $action = $this->item ? 'updated' : 'created';

        $message = 'Item berhasil ' . $lang . ' !';
        $this->dispatchBrowserEvent($action, $message);
        $this->emitTo('item.table', 'refreshTable');
        $this->reset();

    }

    public function render()
    {
        return view('livewire.item.create-or-edit');
    }
}