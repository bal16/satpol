<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileItems extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileItemsFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'content',
        'show',
    ];
}
