<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{
    protected $fillable = [
        'page',
        'image_path',
        'title',
        'subtitle',
        'sort_order',
    ];

    /**
     * Devuelve todos los banners de una página ordenados.
     */
    public static function forPage(string $page): Collection
    {
        return static::where('page', $page)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    /**
     * URL pública de la imagen o null.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    /**
     * Indica si este banner tiene texto para mostrar.
     */
    public function hasText(): bool
    {
        return filled($this->title) || filled($this->subtitle);
    }
}
