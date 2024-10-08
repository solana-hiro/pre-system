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
        Schema::create('trn_sale_headers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('sale_number', 8)->nullable(false)->comment('売上No');
			$table->date('sale_date')->nullable(true)->comment('売上日');
			$table->bigInteger('mt_user_input_id')->unsigned()->nullable(false)->comment('ユーザマスタ入力者ＩＤ');
			$table->bigInteger('trn_order_receive_header_id')->unsigned()->nullable(false)->comment('受注ヘッダＩＤ');
			$table->bigInteger('mt_customer_class1_id')->unsigned()->nullable(true)->comment('得意先分類１マスタＩＤ');
			$table->tinyInteger('cash_kbn')->nullable(false)->default(0)->comment('現金区分');
			$table->bigInteger('mt_user_manager_id')->unsigned()->nullable(true)->comment('ユーザマスタ担当者ＩＤ');
			$table->tinyInteger('sale_return_kbn')->nullable(false)->default(1)->comment('売上返品区分');
			$table->integer('order_number')->nullable(false)->default(0)->comment('オーダーNo');
			$table->bigInteger('mt_slip_kind_id')->unsigned()->nullable(true)->comment('伝票種別マスタＩＤ');
			$table->bigInteger('mt_delivery_destination_id')->unsigned()->nullable(true)->comment('納品先マスタＩＤ');
			$table->bigInteger('mt_warehouse_id')->unsigned()->nullable(true)->comment('倉庫マスタＩＤ');
			$table->integer('quantity_total')->nullable(true)->comment('数量計');
			$table->bigInteger('amount_total')->nullable(true)->comment('金額計');
			$table->integer('tax')->nullable(true)->comment('税');
			$table->bigInteger('all_total')->nullable(true)->comment('総計');
			$table->string('slip_memo', 40)->nullable(true)->comment('伝票備考');
			$table->tinyInteger('delivery_slip_return_slip_output_flg')->nullable(false)->default(0)->comment('納品書返品申請書出力フラグ');
			$table->tinyInteger('shipping_detail_slip_output_flg')->nullable(false)->default(0)->comment('出荷明細書出力フラグ');
			$table->tinyInteger('process_kbn')->nullable(false)->default(0)->comment('処理区分');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
			$table->bigInteger('mt_customer_id')->unsigned()->nullable(true)->comment('得意先マスタＩＤ');
			$table->string('customer_name', 60)->nullable(false)->comment('得意先名');
			$table->tinyInteger('payment_kbn')->nullable(false)->comment('入金区分');
			$table->string('delivery_destination_name', 60)->nullable(false)->comment('納品先名');
			$table->string('accounting_closing_date', 8)->nullable(true)->comment('今回経理締日付');
			$table->string('billing_address_closing_date', 8)->nullable(true)->comment('今回請求先締日付');
			$table->string('settlement_date', 8)->nullable(true)->comment('今回決済日');
			$table->bigInteger('trn_demand_header_id')->unsigned()->nullable(true)->comment('請求ヘッダＩＤ');
			$table->tinyInteger('customer_name_input_kbn')->nullable(false)->comment('得意先名称入力区分');
			$table->tinyInteger('delivery_destination_name_input_kbn')->nullable(false)->comment('納品先名称入力区分');
            $table->timestamps();
            $table->softDeletes();

            $table->index('sale_number', 'idx_trn_sale_headers_01');
            $table->index('mt_user_input_id', 'idx_trn_sale_headers_02');
            $table->index('trn_order_receive_header_id', 'idx_trn_sale_headers_03');
            $table->index('mt_slip_kind_id', 'idx_trn_sale_headers_04');
            $table->index('mt_delivery_destination_id', 'idx_trn_sale_headers_05');
            $table->index('mt_warehouse_id', 'idx_trn_sale_headers_06');

            $table->foreign('mt_user_input_id', 'foreign_trn_sale_headers_01')->references('id')->on('mt_users');
            $table->foreign('trn_order_receive_header_id', 'foreign_trn_sale_headers_02')->references('id')->on('trn_order_receive_headers');
            $table->foreign('mt_customer_class1_id', 'foreign_trn_sale_headers_03')->references('id')->on('mt_customer_classes');
            $table->foreign('mt_user_manager_id', 'foreign_trn_sale_headers_04')->references('id')->on('mt_users');
            $table->foreign('mt_slip_kind_id', 'foreign_trn_sale_headers_05')->references('id')->on('mt_slip_kinds');
            $table->foreign('mt_delivery_destination_id', 'foreign_trn_sale_headers_06')->references('id')->on('mt_delivery_destinations');
            $table->foreign('mt_warehouse_id', 'foreign_trn_sale_headers_07')->references('id')->on('mt_warehouses');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_sale_headers_08')->references('id')->on('mt_users');
            $table->foreign('mt_customer_id', 'foreign_trn_sale_headers_09')->references('id')->on('mt_customers');
            $table->foreign('trn_demand_header_id', 'foreign_trn_sale_headers_10')->references('id')->on('trn_demand_headers');
            $table->comment('売上ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_sale_headers');
    }
};
