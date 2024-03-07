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
        Schema::create('tipo_regioes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->string('sigla', 20)->nullable();
            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });

        Schema::create('regioes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->string('sigla', 20)->nullable();
            $table->foreignId('tipo_regiao_id')->constrained('tipo_regioes');
            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_regioes');
        Schema::dropIfExists('regioes');

    }
};
