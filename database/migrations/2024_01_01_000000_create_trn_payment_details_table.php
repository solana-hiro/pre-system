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
        Schema::create('trn_payment_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('payment_detail_cd', 2)->nullable(false)->comment('入金明細コード');
			$table->bigInteger('trn_payment_header_id')->unsigned()->nullable(false)->comment('入金ヘッダＩＤ');
			$table->bigInteger('def_payment_kbn_id')->unsigned()->nullable(false)->comment('入金区分定義ＩＤ');
			$table->bigInteger('amount')->nullable(true)->comment('金額');
			$table->bigInteger('mt_bank_id')->unsigned()->nullable(false)->comment('銀行マスタＩＤ');
			$table->string('bill_number', 10)->nullable(true)->comment('手形No');
			$table->date('bill_deadline')->nullable(true)->comment('手形期日');
			$table->date('bill_receipt_date')->nullable(true)->comment('手形受取日');
			$table->string('memo1', 20)->nullable(true)->comment('備考1');
			$table->string('memo2', 20)->nullable(true)->comment('備考2');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('payment_detail_cd', 'idx_trn_payment_details_01');
            $table->foreign('trn_payment_header_id', 'foreign_trn_payment_details_01')->references('id')->on('trn_payment_headers');
            $table->foreign('def_payment_kbn_id', 'foreign_trn_payment_details_02')->references('id')->on('def_payment_kbns');
            $table->foreign('mt_bank_id', 'foreign_trn_payment_details_03')->references('id')->on('mt_banks');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_payment_details_04')->references('id')->on('mt_users');
            $table->comment('入金明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_payment_details');
    }
};
