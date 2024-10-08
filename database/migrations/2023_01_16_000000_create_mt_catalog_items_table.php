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
        Schema::create('mt_catalog_items', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->bigInteger('mt_catalog_id')->unsigned()->nullable(false)->comment('カタログマスタＩＤ');
			$table->bigInteger('mt_member_site_items_id')->unsigned()->nullable(false)->comment('メンバーサイト商品マスタID');
			$table->string('display_sort_order', 3)->nullable(true)->comment('表示順');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_catalog_id', 'idx_mt_catalog_items_01');
            $table->index('mt_member_site_items_id', 'idx_mt_catalog_items_02');
            $table->foreign('mt_catalog_id', 'foreign_mt_catalog_items_01')->references('id')->on('mt_catalogs');
            $table->foreign('mt_member_site_items_id', 'foreign_mt_catalog_items_02')->references('id')->on('mt_member_site_items');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_catalog_items_03')->references('id')->on('mt_users');
            $table->comment('カタログ別商品マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_catalog_items');
    }
};
