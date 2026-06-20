<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('about_hero_image_path')->nullable();
            $table->string('about_hero_subtitle')->default('Legado y Excelencia');
            $table->string('about_hero_title')->default('Nuestra Historia:\nArquitectura y Confort');
            $table->text('about_hero_description')->nullable();
            
            $table->string('about_workshop_subtitle')->default('El Corazón de la Creación');
            $table->string('about_workshop_title')->default('Artesanía de Precisión');
            $table->text('about_workshop_description_1')->nullable();
            $table->text('about_workshop_description_2')->nullable();
            
            $table->string('about_workshop_stat_1_value')->default('25+');
            $table->string('about_workshop_stat_1_label')->default('Años de Maestría');
            $table->string('about_workshop_stat_2_value')->default('100%');
            $table->string('about_workshop_stat_2_label')->default('Fabricación Propia');
            
            $table->string('about_workshop_image_path')->nullable();
            $table->text('about_workshop_quote')->nullable();
            
            $table->string('about_pilar_1_icon')->default('verified');
            $table->string('about_pilar_1_title')->default('Calidad Institucional');
            $table->text('about_pilar_1_desc')->nullable();
            
            $table->string('about_pilar_2_icon')->default('chair_alt');
            $table->string('about_pilar_2_title')->default('Diseño Ergonómico');
            $table->text('about_pilar_2_desc')->nullable();
            
            $table->string('about_pilar_3_icon')->default('eco');
            $table->string('about_pilar_3_title')->default('Compromiso Sostenible');
            $table->text('about_pilar_3_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};
