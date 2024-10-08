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
        Schema::create('mt_member_site_item_recommendation_managements', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->bigInteger('mt_member_site_item_id_base')->unsigned()->nullable(false)->comment('紐付け元メンバーサイト商品マスタID');
			$table->bigInteger('mt_member_site_item_id_recommendation')->unsigned()->nullable(false)->comment('おすすめ先メンバーサイト商品マスタID');
			$table->string('display_sort_order', 3)->nullable(false)->comment('表示順');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_member_site_item_id_base', 'idx_mt_member_site_item_recommendation_managements_01');
            $table->foreign('mt_member_site_item_id_base', 'foreign_mt_member_site_item_recommendation_managements_01')->references('id')->on('mt_member_site_items');
            $table->foreign('mt_member_site_item_id_recommendation', 'foreign_mt_member_site_item_recommendation_managements_02')->references('id')->on('mt_member_site_items');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_member_site_item_recommendation_managements_03')->references('id')->on('mt_users');
            $table->comment('メンバーサイト商品おすすめ管理マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_member_site_item_recommendation_managements');
    }
};
