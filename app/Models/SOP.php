<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOP extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
    ];

    protected $table = 'SOPs';
}
