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
        Schema::create('drens', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // Nom de la DREN
            $table->string('code')->unique()->nullable(); // Code de la DREN
            $table->boolean('disponible')->default(false); // Si les résultats sont disponibles
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drens');
    }
};
