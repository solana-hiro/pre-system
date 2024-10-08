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
        Schema::create('trn_shipping_inspection_headers', function (Blueprint $table) {
			$table->id()->comment('ID');
			$table->date('specify_deadline')->nullable(false)->unique('trn_shipping_inspection_headers_unique_01')->comment('指定納期');
			$table->bigInteger('trn_order_receive_header_id')->unsigned()->nullable(false)->unique('trn_shipping_inspection_headers_unique_02')->comment('受注ヘッダＩＤ');
			$table->string('picking_list_output_sheet_number', 4)->nullable(true)->comment('ピッキングリスト出力枚数');
			$table->bigInteger('mt_user_picking_manager_id')->unsigned()->nullable(true)->comment('ユーザマスタピッキング担当者コードＩＤ');
			$table->bigInteger('mt_user_last_picking_manager_id')->unsigned()->nullable(true)->comment('ユーザマスタ最終ピッキング担当者ＩＤ');
			$table->bigInteger('mt_user_picking_summarize_manager_id')->unsigned()->nullable(true)->comment('ユーザマスタピッキング(大口)担当者コードＩＤ');
			$table->bigInteger('mt_user_inspection_manager_id')->unsigned()->nullable(true)->comment('ユーザマスタ検品担当者ＩＤ');
			$table->tinyInteger('inspection_flg')->nullable(false)->default(0)->comment('検品フラグ');
			$table->tinyInteger('pendding_flg')->nullable(false)->default(0)->comment('保留フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trn_order_receive_header_id', 'idx_trn_shipping_inspection_headers_01');
            $table->index('mt_user_picking_manager_id', 'idx_trn_shipping_inspection_headers_02');
            $table->index('mt_user_last_picking_manager_id', 'idx_trn_shipping_inspection_headers_03');
            $table->index('mt_user_picking_summarize_manager_id', 'idx_trn_shipping_inspection_headers_04');
            $table->index('mt_user_inspection_manager_id', 'idx_trn_shipping_inspection_headers_05');
            $table->foreign('trn_order_receive_header_id', 'foreign_trn_shipping_inspection_headers_01')->references('id')->on('trn_order_receive_headers');
            $table->foreign('mt_user_picking_manager_id', 'foreign_trn_shipping_inspection_headers_02')->references('id')->on('mt_users');
            $table->foreign('mt_user_last_picking_manager_id', 'foreign_trn_shipping_inspection_headers_03')->references('id')->on('mt_users');
            $table->foreign('mt_user_picking_summarize_manager_id', 'foreign_trn_shipping_inspection_headers_04')->references('id')->on('mt_users');
            $table->foreign('mt_user_inspection_manager_id', 'foreign_trn_shipping_inspection_headers_05')->references('id')->on('mt_users');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_shipping_inspection_headers_06')->references('id')->on('mt_users');
            $table->comment('出荷検品ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_shipping_inspection_headers');
    }
};
