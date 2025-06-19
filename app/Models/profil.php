<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // ← Tambahkan ini

class profil extends Model
{
    use HasFactory;
    protected $table = 'profiles'; // 👈 TAMBAHKAN INI
    protected $fillable = [
        'user_id',
        'address',
        'phone_number',
        'profile_picture',
    ];

    // Relasi One to One dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
