<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_path',
        'page_name',
        'ip_address',
        'user_agent',
        'referer',
        'visitor_id',
        'session_duration',
    ];

    protected $casts = [
        'session_duration' => 'integer',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
