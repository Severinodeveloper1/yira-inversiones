<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Faq extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
