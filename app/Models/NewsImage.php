<?php

namespace App\Models;

use Database\Factories\NewsImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    /** @use HasFactory<NewsImageFactory> */
    use HasFactory;

    protected $fillable = [
        'news_id',
        'path',
        // 'caption', // Optional: if you want captions for images
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
