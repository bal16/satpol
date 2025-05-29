<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['name']; // Pastikan name bisa diisi massal jika belum

    // ... properti model lainnya ...

    /**
     * Get the gallery items for the category.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }


}
