<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
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
        'body',
        'slug',
    ];

    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }

    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }
}
