<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'image_src',
        'card_id',
    ];

    /**
     * Get the items for the service.
     */
    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }
}