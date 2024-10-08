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
        Schema::create('trn_pay_headers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('pay_number', 8)->nullable(false)->comment('支払No');
			$table->bigInteger('mt_supplier_id')->unsigned()->nullable(true)->comment('仕入先マスタＩＤ');
			$table->date('pay_closing_date')->nullable(true)->comment('支払締日');
			$table->bigInteger('before_pay_amount')->nullable(true)->comment('前回支払金額');
			$table->bigInteger('now_payment_amount')->nullable(true)->comment('今回支払額');
			$table->bigInteger('offset_discount_amount')->nullable(true)->comment('相殺値引額');
			$table->bigInteger('carried_forward_balance')->nullable(true)->comment('繰越残高');
			$table->bigInteger('now_purchase_amount')->nullable(true)->comment('今回仕入額');
			$table->bigInteger('now_tax_amount')->nullable(true)->comment('今回消費税額');
			$table->bigInteger('now_pay_amount')->nullable(true)->comment('今回支払金額');
			$table->date('money_collection_date')->nullable(true)->comment('集金日');
			$table->tinyInteger('purchase_slip_sheet_number')->nullable(true)->comment('仕入伝票枚数');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('pay_number', 'idx_trn_pay_headers_01');
            $table->foreign('mt_supplier_id', 'foreign_trn_pay_headers_01')->references('id')->on('mt_suppliers');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_pay_headers_02')->references('id')->on('mt_users');
            $table->comment('支払ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_pay_headers');
    }
};
