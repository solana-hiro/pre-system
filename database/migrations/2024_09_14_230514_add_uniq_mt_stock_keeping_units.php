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
        Schema::table('mt_stock_keeping_units', function (Blueprint $table) {
            $table->unique(['mt_item_id', 'mt_color_id', 'mt_size_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_stock_keeping_units', function (Blueprint $table) {
            //
        });
    }
};
