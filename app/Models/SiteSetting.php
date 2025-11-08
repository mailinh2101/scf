<?php

namespace App\Models;

use App\Helpers\AssetHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';

    protected $fillable = ['key', 'value'];

    protected $appends = ['value_url'];

    /**
     * Image-related keys that should be converted to full URLs
     */
    protected static array $imageKeys = [
        // Logo & Icons
        'logo_header', 'logo_footer', 'sub_logo', 'placeholder_image',

        // Home page
        'home_hero_background', 'home_hero_image', 'home_hero_decoration',

        // Contact page
        'contact_hero_image', 'contact_hero_decoration',
        'contact_section_image_left', 'contact_section_image_right',

        // Blog page
        'blog_hero_image', 'blog_hero_decoration',

        // Careers page
        'careers_hero_image', 'careers_hero_decoration',

        // Products page
        'products_hero_image', 'products_hero_decoration',

        // About page
        'about_hero_image', 'about_hero_decoration',

        // Footer
        'footer_decoration_image',
    ];

    /**
     * Get the full URL if this setting is an image
     */
    public function getValueUrlAttribute(): ?string
    {
        // Nếu key này là hình ảnh, chuyển value thành URL
        if (in_array($this->key, static::$imageKeys)) {
            return AssetHelper::assetUrl($this->value);
        }
        return $this->value;
    }
}
