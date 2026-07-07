<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Category extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path',
        'type',
    ];

    protected static function booted()
    {
        static::deleting(function ($category) {
            if ($category->products()->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'category' => 'No se puede eliminar la categoría "' . $category->name . '" porque tiene productos asociados. Reasigne o elimine los productos primero.'
                ]);
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
