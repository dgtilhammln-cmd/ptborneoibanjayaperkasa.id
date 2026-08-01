<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionItem extends Model
{
    protected $fillable = [
        'home_section_id',
        'type',
        'title',
        'description',
        'content',
        'image',
        'icon',
        'link',
        'link_text',
        'extra_data',
        'is_active',
        'order'
    ];

    protected $casts = [
        'extra_data' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function section()
    {
        return $this->belongsTo(HomeSection::class);
    }
}
