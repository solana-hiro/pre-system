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
        Schema::table('mt_notices', function (Blueprint $table) {
            $table->text('notice_content', 15000)->nullable(true)->comment('お知らせ内容')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_notices', function (Blueprint $table) {
            //
        });
    }
};
