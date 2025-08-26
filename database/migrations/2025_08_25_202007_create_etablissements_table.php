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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cisco_id')->constrained()->onDelete('cascade');
            $table->string('nom'); // Nom de l'établissement
            $table->string('code')->nullable(); // Code de l'établissement
            $table->string('type')->nullable(); // EPP, CEG, Lycée
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
