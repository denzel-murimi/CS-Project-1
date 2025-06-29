<?php

namespace App\Models;

// Import the HasFactory trait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Add the HasFactory trait here
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', // Add if you want phone contact
        'student_id', // Add if this is for students
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
