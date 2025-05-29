<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_number',
        'image_path',
    ];

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($model) {
            if ($model->isDirty('image_path') && ($model->getOriginal('image_path') !== null)) {
                Storage::delete($model->getOriginal('image_path'));
            }
        });
    }
}
