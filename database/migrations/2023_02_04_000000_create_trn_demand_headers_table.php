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
        Schema::create('trn_demand_headers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('demand_number', 2)->nullable(false)->comment('請求No');
			$table->bigInteger('mt_illing_address_id')->unsigned()->nullable(false)->comment('請求先マスタＩＤ');
			$table->string('demand_closing_date', 8)->nullable(true)->comment('請求締日');
			$table->bigInteger('before_demand_amount')->nullable(true)->comment('前回請求金額');
			$table->bigInteger('offset_discount_amount')->nullable(true)->comment('相殺値引額');
			$table->bigInteger('now_sale_amount')->nullable(true)->default(0)->comment('今回売上額');
			$table->bigInteger('now_tax_amount')->nullable(true)->default(0)->comment('今回消費税額');
			$table->bigInteger('now_demand_amount')->nullable(true)->default(0)->comment('今回請求金額');
			$table->bigInteger('now_payment_amount')->nullable(true)->default(0)->comment('今回入金額');
			$table->string('now_payment_date', 8)->nullable(true)->comment('今回決済日');
			$table->bigInteger('cash_tran')->nullable(true)->comment('現金・振込');
			$table->bigInteger('bill')->nullable(true)->comment('手形');
			$table->bigInteger('commission_another')->nullable(true)->comment('手数料・他');
			$table->tinyInteger('sale_slip_sheet_number')->nullable(true)->comment('売上伝票枚数');
			$table->tinyInteger('demand_decision_flg')->nullable(false)->default(0)->comment('請求確定フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('demand_number', 'idx_trn_demand_headers_01');
            $table->index('mt_illing_address_id', 'idx_trn_demand_headers_02');
            $table->index('demand_closing_date', 'idx_trn_demand_headers_03');
            $table->foreign('mt_illing_address_id', 'foreign_trn_demand_headers_01')->references('id')->on('mt_billing_addresses');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_demand_headers_02')->references('id')->on('mt_users');
            $table->comment('請求ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_demand_headers');
    }
};
