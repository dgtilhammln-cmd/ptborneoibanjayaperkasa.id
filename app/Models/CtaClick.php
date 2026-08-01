<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtaClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'cta_type',
        'cta_label',
        'cta_url',
        'page_path',
        'ip_address',
        'user_agent',
        'visitor_id',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
