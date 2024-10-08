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
        Schema::create('trn_in_out_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('in_out_detail_cd', 2)->nullable(false)->comment('入出庫明細コード');
			$table->bigInteger('trn_order_receive_detail_id')->unsigned()->nullable(false)->comment('受注明細ＩＤ');
			$table->bigInteger('trn_order_detail_id')->unsigned()->nullable(false)->comment('発注明細ＩＤ');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(false)->comment('商品マスタＩＤ');
			$table->bigInteger('mt_color_id')->unsigned()->nullable(false)->comment('カラーマスタＩＤ');
			$table->bigInteger('mt_size_id')->unsigned()->nullable(false)->comment('サイズマスタＩＤ');
			$table->integer('in_out_quantity')->nullable(true)->comment('入出庫数量');
			$table->string('unit', 2)->nullable(true)->comment('単位');
			$table->bigInteger('in_out_year')->nullable(true)->comment('入出庫年');
			$table->bigInteger('in_out_month')->nullable(true)->comment('入出庫月');
			$table->bigInteger('in_out_date')->nullable(true)->comment('入出庫日');
			$table->bigInteger('dealing_price_tax_out')->nullable(true)->comment('取引単価：税抜');
			$table->bigInteger('dealing_amount')->nullable(true)->comment('取引金額');
			$table->bigInteger('retail_price_tax_out')->nullable(true)->comment('上代単価：税抜');
			$table->bigInteger('retail_amount')->nullable(true)->comment('上代金額');
			$table->string('memo', 100)->nullable(true)->comment('備考');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trn_order_receive_detail_id', 'idx_trn_in_out_details_01');
            $table->foreign('trn_order_receive_detail_id', 'foreign_trn_in_out_details_01')->references('id')->on('trn_order_receive_details');
            $table->foreign('trn_order_detail_id', 'foreign_trn_in_out_details_02')->references('id')->on('trn_order_details');
            $table->foreign('mt_item_id', 'foreign_trn_in_out_details_03')->references('id')->on('mt_items');
            $table->foreign('mt_color_id', 'foreign_trn_in_out_details_04')->references('id')->on('mt_colors');
            $table->foreign('mt_size_id', 'foreign_trn_in_out_details_05')->references('id')->on('mt_sizes');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_in_out_details_06')->references('id')->on('mt_users');
            $table->comment('入出庫明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_in_out_details');
    }
};
