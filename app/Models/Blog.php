<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'author'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            // Hanya generate slug jika kosong
            if (empty($blog->slug)) {
                $blog->slug = \Illuminate\Support\Str::slug($blog->title);
            }
        });
    }

    /**
     * Get total views count from blog_views table
     */
    public function getViewsAttribute()
    {
        return BlogView::where('blog_id', $this->id)->count();
    }

    /**
     * Relationship with blog views
     */
    public function blogViews()
    {
        return $this->hasMany(BlogView::class);
    }
}
