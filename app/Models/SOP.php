<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SOP extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
    ];

    protected $table = "SOPs";

}