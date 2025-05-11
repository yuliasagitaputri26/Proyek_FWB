<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
