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
        Schema::create('trn_sale_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('sale_detail_cd', 3)->nullable(false)->comment('売上明細コード');
			$table->integer('sale_line_no')->nullable(false)->comment('売上行No');
			$table->bigInteger('trn_sale_header_id')->unsigned()->nullable(false)->comment('売上ヘッダＩＤ');
			$table->bigInteger('trn_order_receive_detail_id')->unsigned()->nullable(false)->comment('受注明細ＩＤ');
			$table->bigInteger('def_sale_kbn_id')->unsigned()->nullable(false)->comment('売上区分定義ＩＤ');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(true)->comment('商品マスタＩＤ');
			$table->string('item_name', 40)->nullable(true)->comment('商品名');
			$table->bigInteger('retail_price')->nullable(true)->comment('上代単価');
			$table->integer('sale_quantity')->nullable(true)->comment('売上数');
			$table->string('unit', 4)->nullable(true)->comment('単位');
			$table->tinyInteger('price_rate')->nullable(true)->comment('単価掛率');
			$table->decimal('cost_price', 10, 1)->nullable(true)->comment('原価単価');
			$table->bigInteger('sale_price')->nullable(true)->comment('売上単価');
			$table->bigInteger('cost_amount')->nullable(true)->comment('原価金額');
			$table->bigInteger('sale_amount')->nullable(true)->comment('売上金額');
			$table->integer('sale_tax')->nullable(true)->comment('売上消費税');
			$table->string('memo_1', 10)->nullable(true)->comment('備考１');
			$table->string('memo_2', 10)->nullable(true)->comment('備考２');
			$table->bigInteger('uncollected_balance')->nullable(true)->comment('未回収残高');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
			$table->tinyInteger('item_name_input_kbn')->nullable(true)->comment('商品名称入力区分');
            $table->timestamps();
            $table->softDeletes();

            $table->index('sale_detail_cd', 'idx_trn_sale_details_01');
            $table->index('trn_sale_header_id', 'idx_trn_sale_details_02');
            $table->index('trn_order_receive_detail_id', 'idx_trn_sale_details_03');
            $table->index('mt_item_id', 'idx_trn_sale_details_04');
            $table->foreign('trn_sale_header_id', 'foreign_trn_sale_details_01')->references('id')->on('trn_sale_headers');
            $table->foreign('trn_order_receive_detail_id', 'foreign_trn_sale_details_02')->references('id')->on('trn_order_receive_details');
            $table->foreign('def_sale_kbn_id', 'foreign_trn_sale_details_03')->references('id')->on('def_sale_kbns');
            $table->foreign('mt_item_id', 'foreign_trn_sale_details_04')->references('id')->on('mt_items');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_sale_details_05')->references('id')->on('mt_users');
            $table->comment('売上明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_sale_details');
    }
};
