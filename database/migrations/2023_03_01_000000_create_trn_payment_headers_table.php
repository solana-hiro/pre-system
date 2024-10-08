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
        Schema::create('trn_payment_headers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('payment_number', 8)->nullable(false)->comment('入金No');
			$table->bigInteger('mt_customer_id')->unsigned()->nullable(true)->comment('得意先マスタＩＤ');
			$table->date('payment_date')->nullable(true)->comment('入金日');
			$table->bigInteger('mt_user_id')->unsigned()->nullable(true)->comment('ユーザマスタＩＤ');
			$table->bigInteger('payment_slip_number')->nullable(true)->comment('入金伝票No');
			$table->bigInteger('slip_total')->nullable(true)->comment('伝票計');
			$table->bigInteger('trn_demand_header_id')->unsigned()->nullable(true)->comment('請求ヘッダＩＤ');
			$table->tinyInteger('demand_decision_flg')->nullable(false)->default(0)->comment('請求確定フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('payment_number', 'idx_trn_payment_headers_01');
            $table->foreign('mt_customer_id', 'foreign_trn_payment_headers_01')->references('id')->on('mt_customers');
            $table->foreign('mt_user_id', 'foreign_trn_payment_headers_02')->references('id')->on('mt_users');
            $table->foreign('trn_demand_header_id', 'foreign_trn_payment_headers_03')->references('id')->on('trn_demand_headers');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_payment_headers_04')->references('id')->on('mt_users');
            $table->comment('入金ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_payment_headers');
    }
};
