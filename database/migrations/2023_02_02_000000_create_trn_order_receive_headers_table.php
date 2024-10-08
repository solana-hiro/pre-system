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
        Schema::create('trn_order_receive_headers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('order_receive_number', 8)->nullable(false)->comment('受注No');
			$table->date('order_receive_date')->nullable(true)->comment('受注日');
			$table->bigInteger('mt_user_input_id')->unsigned()->nullable(true)->comment('ユーザマスタ入力者ＩＤ');
			$table->tinyInteger('settlement_method')->nullable(false)->comment('決済方法');
			$table->bigInteger('mt_customer_id')->unsigned()->nullable(true)->comment('得意先マスタＩＤ');
			$table->bigInteger('mt_customer_class_id')->unsigned()->nullable(true)->comment('得意先分類マスタＩＤ');
			$table->string('order_number', 15)->nullable(true)->comment('オーダーNo');
			$table->bigInteger('mt_user_manager_id')->unsigned()->nullable(true)->comment('ユーザマスタ担当者ＩＤ');
			$table->bigInteger('mt_delivery_destination_id')->unsigned()->nullable(true)->comment('納品先マスタＩＤ');
			$table->bigInteger('mt_warehouse_id')->unsigned()->nullable(true)->comment('倉庫マスタＩＤ');
			$table->tinyInteger('payment_guidance_kbn')->nullable(false)->default(0)->comment('入金案内区分');
			$table->tinyInteger('payment_guidance_flg')->nullable(false)->default(0)->comment('入金案内フラグ');
			$table->tinyInteger('shortage_guidance_flg')->nullable(false)->default(0)->comment('欠品案内フラグ');
			$table->tinyInteger('shipping_guidance_flg')->nullable(false)->default(0)->comment('出荷案内フラグ');
			$table->tinyInteger('keep_guidance_target_flg')->nullable(false)->default(0)->comment('ＫＥＥＰ案内対象フラグ');
			$table->tinyInteger('keep_guidance_expiration_flg')->nullable(false)->default(0)->comment('ＫＥＥＰ案内期限切フラグ');
			$table->tinyInteger('keep_guidance_flg')->nullable(false)->default(0)->comment('ＫＥＥＰ案内フラグ');
			$table->tinyInteger('process_kbn')->nullable(false)->default(0)->comment('処理区分');
			$table->string('slip_memo', 40)->nullable(true)->comment('伝票備考');
			$table->integer('quantity_total')->nullable(true)->comment('数量計');
			$table->bigInteger('amount_total')->nullable(true)->comment('金額計');
			$table->integer('postage')->nullable(true)->comment('送料');
			$table->string('customer_order_number', 30)->nullable(true)->comment('得意先発注番号');
			$table->string('separate_mail', 30)->nullable(true)->comment('別便');
			$table->string('shipping_document_description_need_column', 30)->nullable(true)->comment('送り状記載必要欄');
			$table->bigInteger('mt_order_receive_sticky_note_id')->unsigned()->nullable(false)->comment('受注付箋マスタＩＤ');
			$table->tinyInteger('shipping_kbn')->nullable(false)->default(0)->comment('出荷区分');
			$table->tinyInteger('direct_delivery_kbn')->nullable(false)->default(1)->comment('直送区分');
			$table->string('business_memo', 80)->nullable(true)->comment('業務メモ');
			$table->string('picking_list_memo', 80)->nullable(true)->comment('ピッキングリストメモ');
			$table->string('logistic_memo', 80)->nullable(true)->comment('物流への連絡');
			$table->string('ec_order_receive_number', 9)->nullable(true)->comment('ＥＣ注文番号');
			$table->dateTime('ec_order_receive_datetime')->nullable(true)->comment('ＥＣ注文日時');
			$table->bigInteger('mt_manager_id')->unsigned()->nullable(true)->comment('担当者マスタID');
			$table->tinyInteger('ec_order_receive_check_flg')->nullable(false)->default(0)->comment('ＥＣ受注チェックフラグ');
			$table->tinyInteger('delivery_destination_check_flg')->nullable(false)->default(0)->comment('納品先確認フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
			$table->string('settlement_station_demand_number', 17)->nullable(true)->comment('決済ステーション請求番号');
			$table->string('customer_name', 60)->nullable(false)->comment('得意先名');
			$table->tinyInteger('payment_kbn')->nullable(false)->comment('入金区分');
			$table->bigInteger('mt_root_id')->unsigned()->nullable(true)->comment('ルートマスタＩＤ');
			$table->bigInteger('mt_item_class_shipping_companie_id')->unsigned()->nullable(true)->comment('運送会社マスタＩＤ');
			$table->bigInteger('def_arrival_date_id')->unsigned()->nullable(true)->comment('着日定義ＩＤ');
			$table->string('accounting_closing_date', 8)->nullable(false)->comment('今回経理締日付');
			$table->string('delivery_destination_name', 60)->nullable(false)->comment('納品先名');
			$table->tinyInteger('customer_name_input_kbn')->nullable(false)->comment('得意先名称入力区分');
			$table->tinyInteger('delivery_destination_name_input_kbn')->nullable(false)->comment('納品先名称入力区分');
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_receive_number', 'idx_trn_order_receive_headers_01');
            $table->index('mt_user_input_id', 'idx_trn_order_receive_headers_02');
            $table->index('mt_customer_id', 'idx_trn_order_receive_headers_03');
            $table->index('mt_customer_class_id', 'idx_trn_order_receive_headers_04');
            $table->index('mt_user_manager_id', 'idx_trn_order_receive_headers_05');
            $table->index('mt_delivery_destination_id', 'idx_trn_order_receive_headers_06');
            $table->index('mt_warehouse_id', 'idx_trn_order_receive_headers_07');
            $table->index('mt_order_receive_sticky_note_id', 'idx_trn_order_receive_headers_08');
            $table->index('ec_order_receive_number', 'idx_trn_order_receive_headers_09');
            $table->foreign('mt_user_input_id', 'foreign_trn_order_receive_headers_01')->references('id')->on('mt_users');
            $table->foreign('mt_customer_id', 'foreign_trn_order_receive_headers_02')->references('id')->on('mt_customers');
            $table->foreign('mt_customer_class_id', 'foreign_trn_order_receive_headers_03')->references('id')->on('mt_customer_classes');
            $table->foreign('mt_user_manager_id', 'foreign_trn_order_receive_headers_04')->references('id')->on('mt_users');
            $table->foreign('mt_delivery_destination_id', 'foreign_trn_order_receive_headers_05')->references('id')->on('mt_delivery_destinations');
            $table->foreign('mt_warehouse_id', 'foreign_trn_order_receive_headers_06')->references('id')->on('mt_warehouses');
            $table->foreign('mt_order_receive_sticky_note_id', 'foreign_trn_order_receive_headers_07')->references('id')->on('mt_order_receive_sticky_notes');
            $table->foreign('mt_manager_id', 'foreign_trn_order_receive_headers_08')->references('id')->on('mt_managers');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_order_receive_headers_09')->references('id')->on('mt_users');
            $table->foreign('mt_root_id', 'foreign_trn_order_receive_headers_10')->references('id')->on('mt_roots');
            $table->foreign('mt_item_class_shipping_companie_id', 'foreign_trn_order_receive_headers_11')->references('id')->on('mt_item_classes');
            $table->foreign('def_arrival_date_id', 'foreign_trn_order_receive_headers_12')->references('id')->on('def_arrival_dates');
            $table->comment('受注ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_order_receive_headers');
    }
};
