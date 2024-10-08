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
        Schema::create('trn_purchase_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('purchase_detail_cd', 2)->nullable(false)->comment('仕入明細コード');
			$table->bigInteger('trn_purchase_header_id')->unsigned()->nullable(false)->comment('仕入ヘッダＩＤ');
			$table->bigInteger('trn_shipment_detail_id')->unsigned()->nullable(false)->comment('シップ決定明細ＩＤ');
			$table->bigInteger('retail_price_tax_out')->nullable(true)->comment('上代単価：税抜');
			$table->integer('purchase_quantity')->nullable(true)->comment('仕入数');
			$table->string('unit', 2)->nullable(true)->comment('単位');
			$table->bigInteger('purchase_price')->nullable(true)->comment('仕入単価');
			$table->bigInteger('purchase_amount')->nullable(true)->comment('仕入金額');
			$table->integer('purchase_tax')->nullable(true)->comment('仕入消費税');
			$table->string('memo', 100)->nullable(true)->comment('備考');
			$table->date('purchase_accountant_date')->nullable(true)->comment('仕入計上日');
			$table->tinyInteger('purchase_finish_flg')->nullable(false)->default(0)->comment('仕入完了フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('purchase_detail_cd', 'idx_trn_purchase_details_01');
            $table->foreign('trn_purchase_header_id', 'foreign_trn_purchase_details_01')->references('id')->on('trn_purchase_headers');
            $table->foreign('trn_shipment_detail_id', 'foreign_trn_purchase_details_02')->references('id')->on('trn_shipment_details');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_purchase_details_03')->references('id')->on('mt_users');
            $table->comment('仕入明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_purchase_details');
    }
};
