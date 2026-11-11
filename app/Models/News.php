<?php

namespace App\Models;

use Database\Factories\NewsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class News extends Model
{
    /** @use HasFactory<NewsFactory> */
    use HasFactory, HasRichText;

    /**
     * The dynamic rich text attributes.
     *
     * @var array<int|string, string>
     */
    protected $richTextAttributes = [
        'body',
    ];

    protected $fillable = [
        'title',
        'author',
        'body',
        'slug',
    ];

    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }
}
