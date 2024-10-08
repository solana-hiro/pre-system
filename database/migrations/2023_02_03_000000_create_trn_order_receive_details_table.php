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
        Schema::create('trn_order_receive_details', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('order_receive_detail_cd', 3)->nullable(false)->unique()->comment('受注明細コード');
			$table->integer('order_line_no')->nullable(false)->comment('受注行No');
			$table->bigInteger('trn_order_receive_header_id')->unsigned()->nullable(false)->comment('受注ヘッダＩＤ');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(true)->comment('商品マスタＩＤ');
			$table->string('item_name', 40)->nullable(false)->comment('商品名');
			$table->bigInteger('retail_price')->nullable(true)->comment('上代単価');
			$table->integer('order_receive_quantity')->nullable(false)->comment('受注数');
			$table->string('unit', 4)->nullable(true)->comment('単位');
			$table->tinyInteger('price_rate')->nullable(true)->comment('単価掛率');
			$table->decimal('cost_price', 10, 1)->nullable(true)->comment('原価単価');
			$table->bigInteger('order_receive_price')->nullable(true)->comment('受注単価');
			$table->bigInteger('cost_amount')->nullable(true)->comment('原価金額');
			$table->bigInteger('order_receive_amount')->nullable(true)->comment('受注金額');
			$table->tinyInteger('specify_deadline_none_flg')->nullable(false)->default(0)->comment('指定納期予定なしフラグ');
			$table->date('specify_deadline')->nullable(true)->comment('指定納期');
			$table->string('memo_1', 10)->nullable(true)->comment('備考１');
			$table->string('memo_2', 10)->nullable(true)->comment('備考２');
			$table->tinyInteger('order_receive_finish_flg')->nullable(false)->default(0)->comment('受注完了フラグ');
			$table->tinyInteger('shortage_flg')->nullable(false)->default(0)->default(0)->comment('欠品フラグ');
			$table->tinyInteger('remaining_flg')->nullable(false)->default(0)->comment('残フラグ');
			$table->tinyInteger('payment_finish_flg')->nullable(false)->comment('入金済フラグ');
			$table->bigInteger('mt_order_receive_sticky_note_id')->unsigned()->nullable(true)->comment('受注付箋マスタＩＤ');
			$table->string('management_memo', 80)->nullable(true)->comment('管理メモ');
			$table->string('business_memo', 80)->nullable(true)->comment('業務メモ');
			$table->date('guidance_warehousing_date')->nullable(true)->comment('案内入荷日');
			$table->date('payment_date')->nullable(true)->comment('入金日');
			$table->tinyInteger('shipping_preparation_flg')->nullable(false)->default(0)->comment('出荷準備フラグ');
			$table->tinyInteger('picking_list_output_flg')->nullable(false)->default(0)->comment('ピッキングリスト出力フラグ');
			$table->tinyInteger('total_picking_list_output_flg')->nullable(false)->default(0)->comment('トータルピッキングリスト出力フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
			$table->tinyInteger('item_name_input_kbn')->unsigned()->nullable(false)->comment('商品名称入力区分');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trn_order_receive_header_id', 'idx_trn_order_receive_details_01');
            $table->index('mt_item_id', 'idx_trn_order_receive_details_02');
            $table->index('mt_order_receive_sticky_note_id', 'idx_trn_order_receive_details_03');

            $table->foreign('trn_order_receive_header_id', 'foreign_trn_order_receive_details_01')->references('id')->on('trn_order_receive_headers');
            $table->foreign('mt_item_id', 'foreign_trn_order_receive_details_02')->references('id')->on('mt_items');
            $table->foreign('mt_order_receive_sticky_note_id', 'foreign_trn_order_receive_details_03')->references('id')->on('mt_order_receive_sticky_notes');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_order_receive_details_04')->references('id')->on('mt_users');
            $table->comment('受注明細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_order_receive_details');
    }
};
