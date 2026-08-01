<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'price',
        'image',
        'images',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            // Hanya generate slug jika kosong
            if (empty($product->slug)) {
                $product->slug = \Illuminate\Support\Str::slug($product->name);
            }
        });
    }

    /**
     * Get all product images (including main image)
     */
    public function getAllImages()
    {
        $images = [];
        
        // Add main image if exists
        if ($this->image) {
            $images[] = $this->image;
        }
        
        // Add additional images if exists
        if ($this->images && is_array($this->images)) {
            $images = array_merge($images, $this->images);
        }
        
        // Remove duplicates and return
        return array_unique($images);
    }

    /**
     * Get the category that owns the product
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category', 'slug');
    }
}
