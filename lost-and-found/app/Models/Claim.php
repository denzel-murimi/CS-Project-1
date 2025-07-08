<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'message',
        'contact_info',
        'status',
        'appeal_count',
        'photo_path',
    ];

    /**
     * Get the user who made the claim.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item associated with the claim.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function lostItem()
    {
        return $this->belongsTo(Item::class, 'lost_item_id');
    }

}
