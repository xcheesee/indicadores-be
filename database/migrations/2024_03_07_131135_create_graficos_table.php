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
        Schema::create('graficos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 45);
            $table->string('subtitulo', 60)->nullable();
            $table->enum('tipo_grafico', ['barra', 'linha', 'area', 'pizza']);
            $table->foreignId('projeto_id')->constrained('projetos');
            $table->foreignId('indicador_id')->constrained('indicadores');
            $table->foreignId('tipo_medida_id')->constrained('tipo_medidas');
            $table->enum('label', ['regiao', 'periodo']);
            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graficos');
    }
};
