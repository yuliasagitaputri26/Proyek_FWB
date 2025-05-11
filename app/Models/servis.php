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
    ];

    // Relasi Many to Many dengan Orders melalui tabel pivot order_service
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_service')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }
}
