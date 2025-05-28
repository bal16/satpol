<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Import Attribute

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'category',
    ];

    /**
     * Get the full URL for the gallery image.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? asset('storage/' . $value) : null,
        );
    }

    // If your timestamps are not named created_at/updated_at or you don't use them
    // public $timestamps = false; // or true by default

    // If your date columns should be Carbon instances
    // protected $dates = ['created_at', 'updated_at']; // Example
}
