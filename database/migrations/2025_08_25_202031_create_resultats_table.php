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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidat_id')->constrained()->onDelete('cascade');
            $table->foreignId('examen_id')->constrained()->onDelete('cascade');
            $table->foreignId('serie_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('resultat', ['Admis', 'Non Admis']);
            $table->decimal('moyenne', 4, 2); // Moyenne générale
            $table->string('mention')->nullable(); // Mention obtenue
            $table->integer('annee_scolaire'); // Année scolaire
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};
