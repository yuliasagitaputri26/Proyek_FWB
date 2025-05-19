<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'tersedia', // Menambahkan kolom stok
    ];

    // Relasi Many to Many dengan Orders melalui tabel pivot order_service
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_service')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }

    // Method untuk mengurangi stok
    public function reduceStock($quantity)
    {
        if ($this->tersedia >= $quantity) {
            $this->tersedia -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }
}
