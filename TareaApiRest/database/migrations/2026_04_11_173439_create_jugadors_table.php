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
        Schema::create('jugadors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('dorsal');
            $table->string('ciudad_nacimiento');
            $table->string('pais_nacimiento');
            $table->date('fecha_nacimiento');
            $table->enum('posicion', ['PT', 'LD', 'LI', 'DF', 'MC', 'MD', 'MI', 'ED', 'EI', 'DC']);
            
            // Relación con la tabla clubs
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadors');
    }
};
