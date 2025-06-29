<?php

namespace App\Models;

<<<<<<< HEAD
// Add this relationship to your existing User model

=======
// Import the HasFactory trait
>>>>>>> 6d1e0bcd65568184a1d7d2b11673d9db18ace0b3
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
<<<<<<< HEAD
    use HasApiTokens, HasFactory, Notifiable;
=======
    // Add the HasFactory trait here
    use HasFactory, HasApiTokens, Notifiable;
>>>>>>> 6d1e0bcd65568184a1d7d2b11673d9db18ace0b3

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define the relationship with items.
     * A user can have many items (both lost and found).
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Define the relationship for lost items specifically.
     * A user can have many lost items.
     */
    public function lostItems()
    {
        return $this->hasMany(Item::class)->where('type', 'lost');
    }

    /**
     * Define the relationship for found items specifically.
     * A user can have many found items.
     */
    public function foundItems()
    {
        return $this->hasMany(Item::class)->where('type', 'found');
    }
}
