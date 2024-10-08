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
        Schema::create('mt_stock_keeping_units', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(false)->comment('商品マスタＩＤ');
			$table->bigInteger('mt_color_id')->unsigned()->nullable(false)->comment('カラーマスタＩＤ');
			$table->bigInteger('mt_size_id')->unsigned()->nullable(false)->comment('サイズマスタＩＤ');
			$table->string('jan_cd', 13)->unique()->nullable(true)->comment('ＪＡＮコード');
			$table->tinyInteger('hidden_flg')->nullable(false)->comment('非表示フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_item_id', 'idx_mt_stock_keeping_units_01');
            $table->foreign('mt_item_id', 'foreign_mt_stock_keeping_units_01')->references('id')->on('mt_items');
            $table->foreign('mt_color_id', 'foreign_mt_stock_keeping_units_02')->references('id')->on('mt_colors');
            $table->foreign('mt_size_id', 'foreign_mt_stock_keeping_units_03')->references('id')->on('mt_sizes');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_stock_keeping_units_04')->references('id')->on('mt_users');
            $table->comment('SKUマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_stock_keeping_units');
    }
};
