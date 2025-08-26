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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // CEPE, BEPC, BACC
            $table->text('description');
            $table->string('date'); // Date de l'examen
            $table->string('niveau'); // Primaire, Collège, Lycée
            $table->string('duree'); // Durée de l'examen
            $table->decimal('note_eliminatoire', 3, 1); // Note éliminatoire
            $table->decimal('moyenne_admission', 3, 1); // Moyenne d'admission
            $table->boolean('actif')->default(true); // Si l'examen est actif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
