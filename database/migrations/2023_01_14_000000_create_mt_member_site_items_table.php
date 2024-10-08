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
        Schema::create('mt_member_site_items', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
            $table->string('ec_item_cd', 20)->nullable(false)->comment('メンバーサイト商品コード');
            $table->string('ec_item_name', 30)->nullable(false)->comment('メンバーサイト商品名');
            $table->string('ranking', 3)->nullable(true)->comment('ランキング');
            $table->tinyInteger('printed_products_flg')->nullable(false)->default(0)->comment('プリント商品フラグ');
            $table->bigInteger('mt_item_class1_id')->unsigned()->nullable(false)->comment('商品分類１マスタＩＤ');
            $table->bigInteger('mt_item_class2_id')->unsigned()->nullable(true)->comment('商品分類２マスタＩＤ');
            $table->bigInteger('mt_item_class3_id')->unsigned()->nullable(true)->comment('商品分類３マスタＩＤ');
            $table->bigInteger('mt_item_class4_id')->unsigned()->nullable(true)->comment('商品分類４マスタＩＤ');
            $table->string('item_image_file_1', 256)->nullable(true)->comment('商品画像ファイル１');
            $table->string('item_image_file_2', 256)->nullable(true)->comment('商品画像ファイル２');
            $table->string('item_image_file_3', 256)->nullable(true)->comment('商品画像ファイル３');
            $table->string('item_image_file_4', 256)->nullable(true)->comment('商品画像ファイル４');
            $table->string('pdf_file_1', 256)->nullable(true)->comment('PDFファイル１');
            $table->string('pdf_file_2', 256)->nullable(true)->comment('PDFファイル２');
            $table->string('pdf_file_3', 256)->nullable(true)->comment('PDFファイル３');
            $table->string('pdf_file_4', 256)->nullable(true)->comment('PDFファイル４');
            $table->string('pdf_file_5', 256)->nullable(true)->comment('PDFファイル４');
            $table->string('item_banner_image_file_1', 256)->nullable(true)->comment('商品バナー画像ファイル１');
            $table->string('item_banner_image_file_2', 256)->nullable(true)->comment('商品バナー画像ファイル２');
            $table->string('item_memo_1', 30)->nullable(true)->comment('商品備考１');
            $table->string('item_memo_2', 30)->nullable(true)->comment('商品備考２');
            $table->string('item_memo_3', 30)->nullable(true)->comment('商品備考３');
            $table->string('item_memo_4', 30)->nullable(true)->comment('商品備考４');
            $table->string('item_memo_5', 30)->nullable(true)->comment('商品備考５');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');

            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_item_class1_id', 'idx_mt_member_site_items_01');
            $table->index('mt_item_class2_id', 'idx_mt_member_site_items_02');
            $table->index('mt_item_class3_id', 'idx_mt_member_site_items_03');
            $table->index('mt_item_class4_id', 'idx_mt_member_site_items_04');
            $table->foreign('mt_item_class1_id', 'foreign_mt_member_site_items_01')->references('id')->on('mt_item_classes');
            $table->foreign('mt_item_class2_id', 'foreign_mt_member_site_items_02')->references('id')->on('mt_item_classes');
            $table->foreign('mt_item_class3_id', 'foreign_mt_member_site_items_03')->references('id')->on('mt_item_classes');
            $table->foreign('mt_item_class4_id', 'foreign_mt_member_site_items_04')->references('id')->on('mt_item_classes');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_member_site_items_05')->references('id')->on('mt_users');
            $table->comment('メンバーサイト商品マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_member_site_items');
    }
};



