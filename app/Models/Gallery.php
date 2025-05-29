<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute; // Import Attribute

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'category',
    ];



    protected static function boot()
    {
        parent::boot();
        static::updating(function ($model) {

            if ($model->isDirty('path') && ($model->getOriginal('path') !== null)) {
                Storage::delete($model->getOriginal('path'));
            }
        });
    }

    // If your timestamps are not named created_at/updated_at or you don't use them
    // public $timestamps = false; // or true by default

    // If your date columns should be Carbon instances
    // protected $dates = ['created_at', 'updated_at']; // Example
}