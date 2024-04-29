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
        Schema::table('valores', function (Blueprint $table) {
            $table->string('categoria', 45)->nullable()->after('periodo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valores', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};
