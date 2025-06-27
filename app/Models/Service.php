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

    /**
     * Accessor untuk mengubah konten rich text (HTML) menjadi array link.
     * Dipanggil secara otomatis saat kita mengakses $service->links.
     */
    public function getLinksAttribute(): array
    {
        // Jika body kosong, kembalikan array kosong
        if (empty($this->body?->body)) {
            return [];
        }

        $links = [];
        $dom = new \DOMDocument();
        // Menggunakan @ untuk menekan warning jika HTML tidak sempurna
        // Trix editor membungkus konten dalam div, jadi kita muat sebagai HTML penuh
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $this->body->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $a_tags = $dom->getElementsByTagName('a');

        foreach ($a_tags as $a_tag) {
            $links[] = [
                'text' => $dom->saveHTML($a_tag), // Ambil seluruh HTML di dalam tag <a>
                'href' => $a_tag->getAttribute('href'),
                'isHtml' => true, // Selalu anggap sebagai HTML
            ];
        }

        return $links;
    }
}
