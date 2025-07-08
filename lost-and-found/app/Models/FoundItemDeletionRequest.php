<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundItemDeletionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'reason',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
