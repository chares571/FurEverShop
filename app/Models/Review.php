<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'title',
        'feedback',
    ];

    protected $casts = [
        'rating' => 'integer',
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
            $stars .= $i < $this->rating ? '★' : '☆';
        }
        return $stars;
    }
}
