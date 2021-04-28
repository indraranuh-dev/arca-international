<?php

namespace Modules\Invoice\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Item\Entities\Item;

class InvoicesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoices_id', 'item_id', 'item_name', 'item_price', 'item_discount', 'qty',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}