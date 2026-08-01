<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'sections',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'is_published',
        'order',
        'show_in_menu',
    ];

    protected $casts = [
        'sections' => 'array',
        'is_published' => 'boolean',
        'show_in_menu' => 'boolean',
    ];


    /**
     * Get pages that should appear in menu
     */
    public static function menuPages()
    {
        return self::where('is_published', true)
            ->where('show_in_menu', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get SEO title (meta_title or title as fallback)
     */
    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title;
    }

    /**
     * Get a section by key
     */
    public function getSection(string $key, $default = null)
    {
        $sections = $this->sections ?? [];
        return $sections[$key] ?? $default;
    }

    /**
     * Check if a section is active
     */
    public function isSectionActive(string $key): bool
    {
        $section = $this->getSection($key, []);
        return ($section['is_active'] ?? true) !== false;
    }
}
