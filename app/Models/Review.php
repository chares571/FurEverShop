<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public const ADMIN_DISPLAY_NAME = 'furevershop';

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'title',
        'feedback',
        'admin_reply',
        'admin_replied_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'admin_replied_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStarsAttribute(): string
    {
        $stars = '';
        for ($i = 0; $i < 5; $i++) {
            $stars .= $i < $this->rating ? 'â˜…' : 'â˜†';
        }
        return $stars;
    }

    public function getHasAdminReplyAttribute(): bool
    {
        return filled($this->admin_reply);
    }
}
