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
        Schema::create('trn_shipment_breakdowns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('trn_shipment_detail_id')->unsigned()->nullable(false)->comment('シップ決定明細ID');
			$table->bigInteger('mt_stock_keeping_unit_id')->unsigned()->nullable(false)->unique()->comment('ＳＫＵマスタＩＤ');
			$table->integer('order_quantity')->nullable(false)->comment('発注数');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trn_shipment_detail_id', 'idx_trn_shipment_breakdowns_01');
            $table->index('mt_stock_keeping_unit_id', 'idx_trn_shipment_breakdowns_02');
            $table->foreign('trn_shipment_detail_id', 'foreign_trn_shipment_breakdowns_01')->references('id')->on('trn_shipment_details');
            $table->foreign('mt_stock_keeping_unit_id', 'foreign_trn_shipment_breakdowns_02')->references('id')->on('mt_stock_keeping_units');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_shipment_breakdowns_03')->references('id')->on('mt_users');
            $table->comment('シップ決定内訳');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_shipment_breakdowns');
    }
};
