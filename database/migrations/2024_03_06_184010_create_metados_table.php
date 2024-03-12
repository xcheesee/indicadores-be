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
        Schema::create('metadados', function (Blueprint $table) {
            $table->id();
            //$table->string('nome', 45);
            $table->foreignId('tipo_medida_id')->nullable()->constrained('tipo_medidas');
            $table->string('serie_historica_inicio', 45)->nullable();
            $table->string('serie_historica_fim', 45)->nullable();
            $table->boolean('serie_historica_ativo')->nullable()->default(1);
            $table->text('nota_tecnica')->nullable();
            $table->string('organizacao', 45)->nullable();
            $table->text('observacao')->nullable();
            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metadados');
    }
};
