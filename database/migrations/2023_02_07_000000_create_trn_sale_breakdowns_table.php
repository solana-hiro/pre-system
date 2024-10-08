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
        Schema::create('trn_sale_breakdowns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('trn_sale_detail_id')->unsigned()->nullable(false)->comment('売上明細ＩＤ');
			$table->bigInteger('mt_stock_keeping_unit_id')->unsigned()->nullable(false)->unique()->comment('ＳＫＵマスタＩＤ');
			$table->integer('order_receive_quantity')->nullable(false)->comment('売上数');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
			$table->string('jan_cd', 13)->nullable(false)->comment('JANコード');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trn_sale_detail_id', 'idx_trn_sale_breakdownss_01');
            $table->index('mt_stock_keeping_unit_id', 'idx_trn_sale_breakdowns_02');
            $table->foreign('trn_sale_detail_id', 'foreign_trn_sale_breakdowns_01')->references('id')->on('trn_sale_details');
            $table->foreign('mt_stock_keeping_unit_id', 'foreign_trn_sale_breakdowns_02')->references('id')->on('mt_stock_keeping_units');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_sale_breakdowns_03')->references('id')->on('mt_users');
            $table->comment('売上内訳');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_sale_breakdowns');
    }
};
