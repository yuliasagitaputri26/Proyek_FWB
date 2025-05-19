<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'amount_paid',
        'transaction_date',
    ];

    // Relasi Many to One dengan Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
