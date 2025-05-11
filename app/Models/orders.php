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

    // Relasi One to Many dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many to Many dengan Services melalui tabel pivot order_service
    public function services()
    {
        return $this->belongsToMany(Servis::class, 'order_service')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }

    // Relasi One to Many dengan OrderStatus
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

    // Relasi One to Many dengan Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
