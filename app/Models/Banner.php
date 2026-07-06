<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Banner extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'title',
        'image_path',
        'mobile_image_path',
        'button_text',
        'button_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
