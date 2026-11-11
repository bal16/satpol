<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Import Attribute

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'category_id',
    ];

    /**
     * Get the category that owns the gallery item.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
// If your timestamps are not named created_at/updated_at or you don't use them
// public $timestamps = false; // or true by default

// If your date columns should be Carbon instances
// protected $dates = ['created_at', 'updated_at']; // Example
