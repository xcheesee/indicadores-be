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
        Schema::table('departamentos', function (Blueprint $table) {
            //
            $table->string('nome',255)->change();
        });

        Schema::table('fontes', function (Blueprint $table) {
            //
            $table->string('nome',255)->change();
            $table->string('descricao',255)->change();
        });

        Schema::table('regioes', function (Blueprint $table) {
            //
            $table->string('nome',255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamentos', function (Blueprint $table) {
            //
            $table->string('nome',45)->change();
        });

        Schema::table('fontes', function (Blueprint $table) {
            //
            $table->string('nome',45)->change();
            $table->string('descricao',80)->change();
        });

        Schema::table('regioes', function (Blueprint $table) {
            //
            $table->string('nome',45)->change();
        });
    }
};
