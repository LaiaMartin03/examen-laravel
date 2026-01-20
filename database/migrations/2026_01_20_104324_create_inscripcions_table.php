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
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();

            $table->text('nom');
            $table->text('email');
            
            $table->foreignId('id_fitxer')
            ->constrained('fitxers')
            ->onDelete('cascade');

            $table->foreignId('id_esdeveniment')
            ->constrained('esdeveniments')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcions');
    }
};
