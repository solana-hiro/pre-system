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
        Schema::create('mt_colors', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('color_cd', 4)->nullable(false)->unique()->comment('カラーコード');
			$table->string('color_name', 10)->nullable(true)->comment('カラー名');
			$table->string('html_color_cd', 7)->nullable(true)->comment('HTMLカラーコード');
			$table->string('sort_order', 3)->nullable(false)->comment('並び順');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('color_cd', 'idx_unique_mt_colors_01');
            $table->index('sort_order', 'idx_unique_mt_colors_02');
            $table->foreign('mt_user_last_update_id', 'foreign_unique_mt_colors_01')->references('id')->on('mt_users');
            $table->comment('カラーマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_colors');
    }
};
