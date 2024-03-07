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
        Schema::create('variaveis', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10);
            $table->string('nome', 45)->nullable();
            $table->foreignId('departamento_id')->constrained('departamentos');
            $table->foreignId('tipo_dado_id')->constrained('tipo_dados');
            $table->foreignId('fonte_id')->constrained('fontes');
            $table->foreignId('metado_id')->constrained('metados');
            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });

        Schema::create('indicador_variaveis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicador_id')->constrained('indicadores');
            $table->foreignId('variavel_id')->constrained('variaveis');
            $table->timestamps();
        });

        Schema::create('grafico_variaveis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grafico_id')->constrained('graficos');
            $table->foreignId('variavel_id')->constrained('variaveis');
            $table->timestamps();
        });

        Schema::create('variavel_valores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variavel_id')->constrained('variaveis');
            $table->foreignId('valor_id')->constrained('valores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variaveis_tables');
        Schema::dropIfExists('variaveis');
        Schema::dropIfExists('indicador_variaveis');
        Schema::dropIfExists('grafico_variaveis');
        Schema::dropIfExists('variavel_valores');
        
    }
};
