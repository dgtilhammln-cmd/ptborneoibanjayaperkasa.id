<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogView extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'ip_address',
        'user_agent',
        'referer',
        'visitor_id',
        'view_duration',
    ];

    protected $casts = [
        'view_duration' => 'integer',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
