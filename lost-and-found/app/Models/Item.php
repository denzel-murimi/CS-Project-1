<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'location',
        'date_lost_found',
        'type', // 'lost' or 'found'
        'status', // 'active', 'returned', 'claimed'
        'contact_info',
        'image_path',
        'reward_offered',
        'reward_amount',
    ];

    protected $dates = [
        'date_lost_found',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'date_lost_found' => 'datetime',
        'reward_offered' => 'boolean',
        'reward_amount' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    // Scopes
    public function scopeLost($query)
    {
        return $query->where('type', 'lost');
    }

    public function scopeFound($query)
    {
        return $query->where('type', 'found');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Accessors
    public function getCategoryIconAttribute()
    {
        $icons = [
            'electronics' => 'laptop',
            'clothing' => 'tshirt',
            'accessories' => 'ring',
            'books' => 'book',
            'keys' => 'key',
            'wallet' => 'wallet',
            'phone' => 'mobile-alt',
            'bag' => 'shopping-bag',
            'jewelry' => 'gem',
            'documents' => 'file-alt',
            'sports' => 'futbol',
            'other' => 'question-circle',
        ];

        return $icons[$this->category] ?? 'question-circle';
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'active' => $this->type === 'lost' ? 'red' : 'green',
            'returned' => 'blue',
            'claimed' => 'purple',
        ];

        return $colors[$this->status] ?? 'gray';
    }

    // Methods
    public function isLost()
    {
        return $this->type === 'lost';
    }

    public function isFound()
    {
        return $this->type === 'found';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isReturned()
    {
        return $this->status === 'returned';
    }

    public function markAsReturned()
    {
        $this->update(['status' => 'returned']);
    }

    public function markAsClaimed()
    {
        $this->update(['status' => 'claimed']);
    }

    public function deletionRequest()
    {
    return $this->hasOne(\App\Models\FoundItemDeletionRequest::class);
    }

}
