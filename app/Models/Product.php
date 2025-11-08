<?php

namespace App\Models;

use App\Helpers\AssetHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'image', 'published', 'seo_title', 'seo_description',
        'category',
    ];

    protected $appends = ['image_url'];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug) && ! empty($product->title)) {
                $product->slug = Str::slug($product->title) . '-' . time();
            }
        });
    }

    /**
     * Get the full URL for the product image
     */
    public function getImageUrlAttribute(): ?string
    {
        return AssetHelper::assetUrl($this->image);
    }
}
