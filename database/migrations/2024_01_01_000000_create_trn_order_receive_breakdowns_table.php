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
        Schema::create('trn_order_receive_breakdowns', function (Blueprint $table) {
			$table->id()->comment('ID');
			$table->bigInteger('trn_order_receive_detail_id')->unsigned()->nullable(false)->unique()->comment('受注明細ＩＤ');
			$table->bigInteger('mt_stock_keeping_unit_id')->unsigned()->nullable(false)->unique()->comment('ＳＫＵマスタＩＤ');
			$table->integer('order_receive_quantity')->nullable(false)->comment('受注数');
			$table->integer('inspection_quantity')->nullable(false)->default(0)->comment('検品数');
			$table->tinyInteger('inspection_flg')->nullable(false)->default(0)->comment('検品フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
			$table->string('jan_cd', 13)->nullable(true)->comment('ＪＡＮコード');
			$table->string('shelf_number_1', 10)->nullable(true)->comment('棚番１');
			$table->string('shelf_number_2', 10)->nullable(true)->comment('棚番２');
			$table->string('rank', 2)->nullable(true)->comment('ランク');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trn_order_receive_detail_id', 'idx_trn_order_receive_breakdowns_01');
            $table->foreign('trn_order_receive_detail_id', 'foreign_trn_order_receive_breakdowns_01')->references('id')->on('trn_order_receive_details');
            $table->foreign('mt_stock_keeping_unit_id', 'foreign_trn_order_receive_breakdowns_02')->references('id')->on('mt_stock_keeping_units');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_order_receive_breakdowns_03')->references('id')->on('mt_users');
            $table->comment('受注内訳');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_order_receive_breakdowns');
    }
};
