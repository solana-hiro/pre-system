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
        Schema::create('trn_shippings', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->date('specify_deadline')->nullable(true)->unique()->comment('指定納期');
			$table->bigInteger('trn_order_receive_header_id')->unsigned()->nullable(false)->unique()->comment('受注ヘッダＩＤ');
			$table->bigInteger('mt_user_id')->unsigned()->nullable(false)->comment('ユーザマスタＩＤ');
			$table->bigInteger('mt_shipping_company_id')->unsigned()->nullable(true)->comment('運送会社マスタＩＤ');
			$table->string('piece_number', 3)->nullable(false)->comment('個口数');
			$table->string('shipping_document_numbers', 256)->nullable(false)->comment('送り状番号');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('specify_deadline', 'idx_trn_shippings_01');
            $table->index('trn_order_receive_header_id', 'idx_trn_shippings_02');
            $table->foreign('trn_order_receive_header_id', 'foreign_trn_shippings_01')->references('id')->on('trn_order_receive_headers');
            $table->foreign('mt_user_id', 'foreign_trn_shippings_02')->references('id')->on('mt_users');
            $table->foreign('mt_shipping_company_id', 'foreign_trn_shippings_03')->references('id')->on('mt_shipping_companies');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_shippings_04')->references('id')->on('mt_users');
            $table->comment('出荷情報');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_shippings');
    }
};
