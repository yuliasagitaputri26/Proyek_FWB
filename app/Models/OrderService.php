<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $table = 'order_service'; // Nama tabel pivot

    protected $fillable = [
        'order_id',
        'service_id',
        'quantity',
        'subtotal',
    ];

    // Relasi ke model Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke model Servis
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
