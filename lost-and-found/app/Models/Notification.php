<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'read',
        'action_url',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
