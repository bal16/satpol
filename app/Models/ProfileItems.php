<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class ProfileItems extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileItemsFactory> */
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
        'type',
        'content',
        'body',
        'show',
    ];
}
