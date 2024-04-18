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
        Schema::table('variaveis', function (Blueprint $table) {
            //
            $table->string('nome',60)->change();
        });

        Schema::table('valores', function (Blueprint $table) {
            //
            $table->string('nome',60)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variaveis', function (Blueprint $table) {
            //
            $table->string('nome',45)->change();
        });

        Schema::table('valores', function (Blueprint $table) {
            //
            $table->string('nome',45)->change();
        });
    }
};
