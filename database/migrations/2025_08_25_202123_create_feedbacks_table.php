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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Nom de l'expéditeur
            $table->string('email'); // Email de l'expéditeur
            $table->string('sujet'); // Sujet du feedback
            $table->text('message'); // Message du feedback
            $table->enum('statut', ['nouveau', 'en_cours', 'traite'])->default('nouveau');
            $table->text('reponse')->nullable(); // Réponse de l'administrateur
            $table->date('date'); // Date du feedback
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
