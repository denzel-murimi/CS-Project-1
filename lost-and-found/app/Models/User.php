<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'student_id',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Add this relationship method to your User model
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function lostItems()
    {
        return $this->hasMany(Item::class)->where('type', 'lost');
    }

    public function foundItems()
    {
        return $this->hasMany(Item::class)->where('type', 'found');
    }

    public function isAdmin()
{
    return $this->is_admin;
}

}
