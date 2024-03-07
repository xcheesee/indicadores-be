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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->string('imagem', 100);
            $table->text('nota_tecnica')->nullable();
            $table->text('observacao')->nullable();
            $table->string('formula');
            $table->foreignId('projeto_id')->constrained('projetos');
            $table->foreignId('fonte_id')->constrained('fontes');
            $table->foreignId('departamento_id')->constrained('departamentos');
            $table->foreignId('periodicidade_id')->constrained('periodicidades');
            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadores');
    }
};
