<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'total_price',
        'status',
    ];

    // Relasi ke user (pembuat pesanan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many to Many ke Service (via pivot)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'order_service')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }

    // ✅ Relasi One to Many ke OrderService
    public function orderServices()
    {
        return $this->hasMany(OrderService::class);
    }

    // Relasi ke status pesanan (jika pakai tracking status terpisah)
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

    // Relasi ke transaksi (jika ada pembayaran)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
