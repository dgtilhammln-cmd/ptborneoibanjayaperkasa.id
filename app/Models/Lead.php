<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'whatsapp_number',
        'company_location',
        'requirements',
        'source_url',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'status',
    ];
}
