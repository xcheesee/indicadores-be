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
        Schema::create('valores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->foreignId('regiao_id')->constrained('regioes');
            $table->string('periodo',45); //pode assumir qualquer valor, de número a texto. Pode ser ano, semestre, mês, etc
            $table->float('valor', 16,2);
            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valores');
    }
};
