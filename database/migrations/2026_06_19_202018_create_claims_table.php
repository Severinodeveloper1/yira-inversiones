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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim_number')->unique();
            $table->string('fullname');
            $table->string('document_type');
            $table->string('document_number');
            $table->string('email');
            $table->string('phone');
            $table->string('type'); // 'reclamo' o 'queja'
            $table->text('description');
            $table->string('status')->default('pendiente'); // 'pendiente' o 'atendido'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
