<?php

namespace Modules\Invoice\Entities;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_code', 'user_id', 'user_name', 'user_email', 'status', 'date_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(InvoicesDetail::class, 'invoices_id', 'id');
    }
}