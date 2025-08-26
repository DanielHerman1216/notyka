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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Titre de la notification
            $table->text('message'); // Message de la notification
            $table->enum('type', ['success', 'warning', 'info', 'error']); // Type de notification
            $table->date('date'); // Date de la notification
            $table->boolean('actif')->default(true); // Si la notification est active
            $table->boolean('lu')->default(false); // Si la notification a été lue
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
