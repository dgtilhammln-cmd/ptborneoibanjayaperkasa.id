<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'key',
        'title',
        'heading',
        'subtitle',
        'content',
        'image',
        'image_2',
        'image_3',
        'video_url',
        'extra_data',
        'is_active',
        'order'
    ];

    protected $casts = [
        'extra_data' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function items()
    {
        return $this->hasMany(HomeSectionItem::class)->where('is_active', true)->orderBy('order');
    }

    public function allItems()
    {
        return $this->hasMany(HomeSectionItem::class)->orderBy('order');
    }

    public static function getByKey($key, $activeOnly = true)
    {
        $query = self::where('key', $key);
        if ($activeOnly) {
            $query->where('is_active', true);
        }
        return $query->first();
    }
}
