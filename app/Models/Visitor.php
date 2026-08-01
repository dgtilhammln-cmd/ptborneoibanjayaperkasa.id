<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'referer',
        'device_type',
        'browser',
        'os',
        'country',
        'city',
        'first_visit',
        'last_visit',
        'visit_count',
    ];

    protected $casts = [
        'first_visit' => 'datetime',
        'last_visit' => 'datetime',
    ];

    public function pageViews()
    {
        return $this->hasMany(PageView::class);
    }

    public function blogViews()
    {
        return $this->hasMany(BlogView::class);
    }

    public function ctaClicks()
    {
        return $this->hasMany(CtaClick::class);
    }
}
