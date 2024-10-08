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
        Schema::create('trn_order_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('order_detail_cd', 3)->nullable(false)->comment('発注明細コード');
			$table->bigInteger('trn_order_header_id')->unsigned()->nullable(false)->comment('発注ヘッダＩＤ');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(false)->comment('商品マスタＩＤ');
			$table->bigInteger('retail_price_tax_out')->nullable(true)->comment('上代単価：税抜');
			$table->integer('order_quantity')->nullable(true)->comment('発注数');
			$table->string('unit', 2)->nullable(true)->comment('単位');
			$table->bigInteger('order_price')->nullable(true)->comment('発注単価');
			$table->bigInteger('order_amount')->nullable(true)->comment('発注金額');
			$table->integer('order_tax')->nullable(true)->comment('発注消費税');
			$table->date('order_deadline')->nullable(true)->comment('発注納期');
			$table->string('memo', 100)->nullable(true)->comment('備考');
			$table->tinyInteger('order_finish_flg')->nullable(false)->default(0)->comment('発注完了フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_detail_cd', 'idx_trn_order_details_01');
            $table->foreign('trn_order_header_id', 'foreign_trn_order_details_01')->references('id')->on('trn_order_headers');
            $table->foreign('mt_item_id', 'foreign_trn_order_details_02')->references('id')->on('mt_items');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_order_details_03')->references('id')->on('mt_users');
            $table->comment('発注明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_order_details');
    }
};
