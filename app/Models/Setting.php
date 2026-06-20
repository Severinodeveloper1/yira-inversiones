<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path',
        'phone',
        'whatsapp_phone',
        'email',
        'address',
        'maps_iframe',
        'facebook_url',
        'instagram_url',
        'tiktok_url',
        'youtube_url',
        'catalog_home_path',
        'catalog_office_path',
        'about_hero_image_path',
        'about_hero_subtitle',
        'about_hero_title',
        'about_hero_description',
        'about_workshop_subtitle',
        'about_workshop_title',
        'about_workshop_description_1',
        'about_workshop_description_2',
        'about_workshop_stat_1_value',
        'about_workshop_stat_1_label',
        'about_workshop_stat_2_value',
        'about_workshop_stat_2_label',
        'about_workshop_image_path',
        'about_workshop_quote',
        'about_pilar_1_icon',
        'about_pilar_1_title',
        'about_pilar_1_desc',
        'about_pilar_2_icon',
        'about_pilar_2_title',
        'about_pilar_2_desc',
        'about_pilar_3_icon',
        'about_pilar_3_title',
        'about_pilar_3_desc',
    ];
}
