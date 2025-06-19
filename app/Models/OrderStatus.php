<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status'; // nama tabel sesuai migrasi

    public $timestamps = false; // ← Nonaktifkan created_at dan updated_at otomatis

    protected $fillable = [
        'order_id',
        'status',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
