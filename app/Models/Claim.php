<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Claim extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'claim_number',
        'fullname',
        'document_type',
        'document_number',
        'email',
        'phone',
        'type',
        'description',
        'status',
    ];
}
