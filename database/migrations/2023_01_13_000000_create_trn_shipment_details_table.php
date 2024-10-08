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
        Schema::create('trn_shipment_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('shipment_detail_cd', 3)->nullable(false)->comment('シップ決定明細コード');
			$table->bigInteger('trn_order_detail_id')->unsigned()->nullable(false)->comment('発注明細ＩＤ');
			$table->integer('order_quantity')->nullable(false)->comment('発注数');
			$table->date('stock_date')->nullable(false)->comment('入荷予定日');
			$table->date('order_deadline')->nullable(false)->comment('発注納期');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('shipment_detail_cd', 'idx_trn_order_breakdowns_01');
            $table->index('trn_order_detail_id', 'idx_trn_order_breakdowns_02');
            $table->foreign('trn_order_detail_id', 'foreign_trn_shipment_details_01')->references('id')->on('trn_order_details');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_shipment_details_02')->references('id')->on('mt_users');
            $table->comment('シップ決定明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_shipment_details');
    }
};
