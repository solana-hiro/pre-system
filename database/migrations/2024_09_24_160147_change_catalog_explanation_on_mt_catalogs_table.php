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
        Schema::table('mt_catalogs', function (Blueprint $table) {
            $table->string('catalog_explanation', 15000)->nullable(true)->comment('カタログ説明')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_catalogs', function (Blueprint $table) {
            //
        });
    }
};
