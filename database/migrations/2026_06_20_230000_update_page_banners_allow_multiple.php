<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_banners', function (Blueprint $table) {
            // Eliminar restricción unique para permitir múltiples banners por página
            $table->dropUnique('page_banners_page_unique');
            // Orden de visualización dentro de cada página
            $table->unsignedSmallInteger('sort_order')->default(0)->after('subtitle');
        });
    }

    public function down(): void
    {
        Schema::table('page_banners', function (Blueprint $table) {
            $table->dropColumn('sort_order');
            $table->unique('page');
        });
    }
};
