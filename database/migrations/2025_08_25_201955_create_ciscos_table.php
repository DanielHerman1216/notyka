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
        Schema::create('ciscos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dren_id')->constrained()->onDelete('cascade');
            $table->string('nom'); // Nom de la CISCO
            $table->string('code')->nullable(); // Code de la CISCO
            $table->boolean('disponible')->default(false);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciscos');
    }
};
