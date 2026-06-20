<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ShieldSeeder::class);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Setting::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Yira Inversiones',
                'phone' => '+51 987 654 321',
                'whatsapp_phone' => '51987654321',
                'email' => 'ventas@jiraventas.com',
                'address' => 'Zona Industrial, Lima, Perú',
                'maps_iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243647.25176871638!2d-77.12602125!3d-12.02649875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c5f619ee3ec7%3A0x1407eb77e5c9b7e2!2sLima%2C%20Per%C3%BA!5e0!3m2!1ses!2spe!4v1718872000000!5m2!1ses!2spe',
                'facebook_url' => 'https://facebook.com/yirainversiones',
                'instagram_url' => 'https://instagram.com/yirainversiones',
                'tiktok_url' => 'https://tiktok.com/@yirainversiones',
                'youtube_url' => 'https://youtube.com/@yirainversiones',
                'about_hero_subtitle' => 'Legado y Excelencia',
                'about_hero_title' => "Nuestra Historia:\nArquitectura y Confort",
                'about_hero_description' => 'Desde nuestra fundación, Yira Inversiones ha redefinido los espacios corporativos y residenciales a través de un equilibrio perfecto entre la funcionalidad arquitectónica y el lujo discreto.',
                'about_workshop_subtitle' => 'El Corazón de la Creación',
                'about_workshop_title' => 'Artesanía de Precisión',
                'about_workshop_description_1' => 'Más de 25 años de experiencia avalan nuestro compromiso con la maestría. En nuestro taller, cada pieza es tratada como una obra individual, donde las manos expertas de nuestros artesanos dialogan con las maderas más nobles.',
                'about_workshop_description_2' => 'Fusionamos técnicas ancestrales de ebanistería con tecnología de punta para garantizar tolerancias milimétricas y una durabilidad institucional que trasciende generaciones.',
                'about_workshop_stat_1_value' => '25+',
                'about_workshop_stat_1_label' => 'Años de Maestría',
                'about_workshop_stat_2_value' => '100%',
                'about_workshop_stat_2_label' => 'Fabricación Propia',
                'about_workshop_quote' => '"El mobiliario no es solo un objeto, es la estructura del pensamiento y confort corporativo."',
                'about_pilar_1_icon' => 'verified',
                'about_pilar_1_title' => 'Calidad Institucional',
                'about_pilar_1_desc' => 'Materiales certificados y procesos rigurosos que garantizan una vida útil prolongada bajo uso intensivo.',
                'about_pilar_2_icon' => 'chair_alt',
                'about_pilar_2_title' => 'Diseño Ergonómico',
                'about_pilar_2_desc' => 'Priorizamos la salud y el bienestar del usuario, diseñando piezas que se adaptan a la anatomía humana.',
                'about_pilar_3_icon' => 'eco',
                'about_pilar_3_title' => 'Compromiso Sostenible',
                'about_pilar_3_desc' => 'Uso responsable de recursos, maderas de bosques gestionados y acabados libres de químicos volátiles.',
            ]
        );
    }
}
