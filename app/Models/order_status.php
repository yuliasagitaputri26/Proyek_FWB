<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'updated_at',
    ];

    // Relasi Many to One dengan Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
