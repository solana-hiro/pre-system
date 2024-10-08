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
        Schema::create('mt_order_receive_list_narrow_downs', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('extraction_condition_cd', 6)->nullable(false)->comment('抽出条件コード');
			$table->string('extraction_condition_name', 20)->nullable(false)->comment('抽出条件名');
			$table->string('order_receive_number_from', 8)->nullable(true)->comment('受注No.「From」');
			$table->string('order_receive_number_to', 8)->nullable(true)->comment('受注No.「To」');
			$table->string('member_site_order_receive_number_from', 9)->nullable(true)->comment('メンバーサイト受注No.「From」');
			$table->string('member_site_order_receive_number_to', 9)->nullable(true)->comment('メンバーサイト受注No.「To」');
			$table->tinyInteger('member_site_order_receive_number_all_flg')->nullable(false)->default(1)->comment('メンバーサイト受注No.「すべて」フラグ');
			$table->string('input_manager_from', 4)->nullable(true)->comment('入力担当者「From」');
			$table->string('input_manager_to', 4)->nullable(true)->comment('入力担当者「To」');
			$table->tinyInteger('shipping_kbn')->nullable(false)->comment('出荷区分');
			$table->string('customer_from', 6)->nullable(true)->comment('得意先「From」');
			$table->string('customer_to', 6)->nullable(true)->comment('得意先「To」');
			$table->string('delivery_destination_from', 6)->nullable(true)->comment('納品先「From」');
			$table->string('delivery_destination_to', 6)->nullable(true)->comment('納品先「To」');
			$table->bigInteger('mt_root_id')->unsigned()->nullable(true)->comment('ルートマスタＩＤ');
			$table->tinyInteger('ec_order_receive_check')->nullable(false)->default(2)->comment('EC受注チェック');
			$table->tinyInteger('payment_kbn')->nullable(false)->default(2)->comment('入金区分');
			$table->tinyInteger('shortage')->nullable(false)->default(2)->comment('欠品');
			$table->tinyInteger('order_receive_remaining')->nullable(false)->default(2)->comment('受注残');
			$table->tinyInteger('payment_finish')->nullable(false)->default(2)->comment('入金済');
			$table->tinyInteger('japan_post_office_alignment')->nullable(false)->default(2)->comment('日本郵政連携');
			$table->tinyInteger('credit_settlement')->nullable(false)->default(3)->comment('クレジット決済');
			$table->tinyInteger('detail_sticky_note_0')->nullable(false)->default(1)->comment('明細付箋0');
			$table->tinyInteger('detail_sticky_note_1')->nullable(false)->default(1)->comment('明細付箋1');
			$table->tinyInteger('detail_sticky_note_2')->nullable(false)->default(1)->comment('明細付箋2');
			$table->tinyInteger('detail_sticky_note_3')->nullable(false)->default(1)->comment('明細付箋3');
			$table->tinyInteger('detail_sticky_note_4')->nullable(false)->default(1)->comment('明細付箋4');
			$table->tinyInteger('detail_sticky_note_5')->nullable(false)->default(1)->comment('明細付箋5');
			$table->tinyInteger('detail_sticky_note_6')->nullable(false)->default(1)->comment('明細付箋6');
			$table->tinyInteger('detail_sticky_note_7')->nullable(false)->default(1)->comment('明細付箋7');
			$table->tinyInteger('detail_sticky_note_8')->nullable(false)->default(1)->comment('明細付箋8');
			$table->tinyInteger('detail_sticky_note_9')->nullable(false)->default(1)->comment('明細付箋9');
			$table->tinyInteger('detail_sticky_note_10')->nullable(false)->default(1)->comment('明細付箋10');
			$table->tinyInteger('payment_guidance_slip')->nullable(false)->default(3)->comment('入金案内「対象伝票」');
			$table->tinyInteger('payment_guidance_issue')->nullable(false)->default(2)->comment('入金案内「発行状況」');
			$table->tinyInteger('keep_guidance_slip')->nullable(false)->default(3)->comment('KEEP案内「対象伝票」');
			$table->tinyInteger('keep_guidance_issue')->nullable(false)->default(2)->comment('KEEP案内「発行状況」');
			$table->tinyInteger('shortage_guidance_issue')->nullable(false)->default(2)->comment('欠品案内「発行状況」');
			$table->tinyInteger('shipping_guidance_order_receive_issue')->nullable(false)->default(2)->comment('出荷案内（受注）「発行状況」');
			$table->tinyInteger('shipping_guidance_sale_issue')->nullable(false)->default(2)->comment('出荷案内（売上）「発行状況」');
			$table->tinyInteger('shipping_preparation')->nullable(false)->default(4)->comment('出荷準備');
			$table->tinyInteger('picking_list_issue')->nullable(false)->default(4)->comment('ピッキングリスト発行');
			$table->tinyInteger('inspection')->nullable(false)->default(5)->comment('検品');
			$table->tinyInteger('sale_slip_issue')->nullable(false)->default(4)->comment('売伝発行');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('extraction_condition_cd', 'idx_mt_order_receive_list_narrow_downs_01');
            $table->foreign('mt_root_id', 'morlnd_mt_root_id_foreign_01')->references('id')->on('mt_roots');
            $table->foreign('mt_user_last_update_id', 'morlnd_mt_root_id_foreign_02')->references('id')->on('mt_users');
            $table->comment('受注リスト絞込マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_order_receive_list_narrow_downs');
    }
};
