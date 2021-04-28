<?php

namespace App\Http\Livewire\Invoice;

use Livewire\Component;
use Modules\Invoice\Entities\Invoice;
use Modules\Invoice\Entities\InvoicesDetail;
use Modules\Item\Entities\Item;

class ItemTable extends Component
{
    public $invoiceId, $total, $totalAsArray, $items, $amount, $temporaryItems = [[
        'itemId' => null,
        'itemName' => null,
        'itemPriceDisplay' => null,
        'itemPrice' => null,
        'itemDiscountDisplay' => null,
        'itemDiscount' => null,
        'itemQty' => null,
        'currentStock' => null,
        'subTotal' => null,
    ]];

    protected $listeners = [
        'invoiceCreated' => 'findInvoice',
    ];

    public function mount()
    {
        $this->items = Item::orderBy('name')->get()->toArray();
    }

    public function updatedTemporaryItems()
    {
        foreach ($this->temporaryItems as $key => $temporaryItem) {
            $item = Item::find($temporaryItem['itemId']);

            // if the item is found
            if ($item) {

                // Set the exist array (temporaryItems) with this value
                $this->temporaryItems[$key]['itemPriceDisplay'] = currency($item->price, 'Rp.');
                $this->temporaryItems[$key]['itemName'] = $item->name;
                $this->temporaryItems[$key]['itemPrice'] = $item->price;
                $this->temporaryItems[$key]['itemDiscountDisplay'] = $item->discount . '%';
                $this->temporaryItems[$key]['itemDiscount'] = $item->discount;
                $this->temporaryItems[$key]['itemQty'] = $temporaryItem['itemQty'];
                $this->temporaryItems[$key]['currentStock'] = $item->qty;

                // Check if the quantity was fired (have value)
                if ($temporaryItem['itemQty']) {

                    // Ensure that the value entered is not more than the amount of stock available
                    if ($temporaryItem['itemQty'] > $temporaryItem['currentStock']) {
                        $this->temporaryItems[$key]['itemQty'] = null;
                    } else {
                        // Calculate the subtotal
                        $subTotal = ($item->price - ($item->price * ($item->discount / 100))) * $temporaryItem['itemQty'];
                        $this->temporaryItems[$key]['subTotal'] = $subTotal;

                        $this->countTotal();
                    }
                }

            } else {
                // If the item not found, all values return to null
                $this->temporaryItems[$key]['itemPriceDisplay'] = null;
                $this->temporaryItems[$key]['itemName'] = null;
                $this->temporaryItems[$key]['itemPrice'] = null;
                $this->temporaryItems[$key]['itemDiscountDisplay'] = null;
                $this->temporaryItems[$key]['itemDiscount'] = null;
                $this->temporaryItems[$key]['itemQty'] = null;
                $this->temporaryItems[$key]['currentStock'] = null;
            }
        }

    }

    public function countTotal()
    {
        // Collect subtotal
        $totalAsArray = array_map(function ($tempItem) {
            return $tempItem['subTotal'];
        }, $this->temporaryItems);

        // Calculate the total from the results of the subtotal mapping
        $this->total = array_sum($totalAsArray);
    }

    public function findInvoice($invoiceCode)
    {
        $invoice = Invoice::where('invoice_code', $invoiceCode)->first();
        $this->invoiceId = $invoice ? $invoice->id : null;
        $this->createInvoiceDetails();
    }

    public function createInvoiceDetails()
    {
        $details = array_map(function ($temporaryItem) {

            // Formatting existing array to db column
            return [
                'invoices_id' => $this->invoiceId,
                'item_id' => $temporaryItem['itemId'],
                'item_name' => $temporaryItem['itemName'],
                'item_price' => $temporaryItem['itemPrice'],
                'item_discount' => $temporaryItem['itemDiscount'],
                'qty' => $temporaryItem['itemQty'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

        }, $this->temporaryItems);

        // Insert to invoices_details table
        $invoiceDetail = InvoicesDetail::insert($details);

        // Reduce stock on the item table
        if ($invoiceDetail) {
            foreach ($details as $detail) {
                $item = Item::find($detail['item_id']);
                $item->qty -= $detail['qty'];
                $item->save();
            }
        }

        $this->emitTo('invoice.create-or-edit', 'detailsCreated');
        $this->reset();
        $this->items = Item::orderBy('name')->get()->toArray();
    }

    public function addRow()
    {
        return array_push($this->temporaryItems, [
            'itemId' => null,
            'itemName' => null,
            'itemPriceDisplay' => null,
            'itemPrice' => null,
            'itemDiscountDisplay' => null,
            'itemDiscount' => null,
            'itemQty' => null,
            'currentStock' => null,
            'subTotal' => null,
        ]);

    }

    public function removeRow($i)
    {
        array_splice($this->temporaryItems, $i, 1);
        return $this->countTotal();
    }

    public function render()
    {
        return view('livewire.invoice.item-table');
    }
}