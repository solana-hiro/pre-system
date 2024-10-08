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
        Schema::create('trn_pay_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('trn_pay_header_id')->unsigned()->nullable(false)->comment('支払ヘッダＩＤ');
			$table->bigInteger('trn_purchase_detail_id')->unsigned()->nullable(false)->comment('仕入明細ＩＤ');
			$table->string('pay_kbn', 2)->nullable(false)->comment('支払区分');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trn_pay_header_id', 'idx_trn_pay_details_01');
            $table->foreign('trn_pay_header_id', 'foreign_trn_pay_details_01')->references('id')->on('trn_pay_headers');
            $table->foreign('trn_purchase_detail_id', 'foreign_trn_pay_details_02')->references('id')->on('trn_purchase_details');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_pay_details_03')->references('id')->on('mt_users');
            $table->comment('仕入明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_pay_details');
    }
};
