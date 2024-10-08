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
        Schema::create('favorite', function (Blueprint $table) {
			$table->id()->unique('favorite_unique_01')->comment('ID');
			$table->bigInteger('mt_manager_id')->unsigned()->nullable(false)->comment('担当者マスタＩＤ');
			$table->bigInteger('mt_stock_keeping_unit_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['mt_manager_id', 'mt_stock_keeping_unit_id'], 'favorite_unique_02');
            $table->index('mt_manager_id', 'idx_favorite_01');
            $table->index('mt_stock_keeping_unit_id', 'idx_favorite_02');
            $table->foreign('mt_manager_id', 'foreign_favorite_01')->references('id')->on('mt_managers');
            $table->foreign('mt_stock_keeping_unit_id', 'foreign_favorite_02')->references('id')->on('mt_member_site_items');
            $table->comment('お気に入り情報');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('favorite');
    }
};
