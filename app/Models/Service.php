<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'meta_title',
        'meta_description',
        'advantages'
    ];

    protected $casts = [
        'advantages' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            // Hanya generate slug jika kosong
            if (empty($service->slug)) {
                $service->slug = \Illuminate\Support\Str::slug($service->name);
            }
        });
    }
}
