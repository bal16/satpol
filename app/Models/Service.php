<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText; // 1. Import trait

class Service extends Model
{
    use HasFactory;
    use HasRichText; // 2. Gunakan trait

    protected $fillable = [
        'title',
        'body', // Ditangani oleh HasRichText trait
        'image_src',
        'card_id',
    ];

    protected $richTextAttributes = [
        'body', // Definisikan field rich text di sini
    ];

    // Properti $richTextFields tidak lagi digunakan di versi terbaru, gunakan $richTextAttributes

    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }
}
