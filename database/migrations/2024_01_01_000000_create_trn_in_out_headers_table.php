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
        Schema::create('trn_in_out_headers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('in_out_number', 8)->nullable(false)->comment('入出庫No');
			$table->tinyInteger('process_kbn')->nullable(false)->default(0)->comment('処理区分');
			$table->date('slip_date')->nullable(true)->comment('伝票日付');
			$table->bigInteger('mt_user_id')->unsigned()->nullable(true)->comment('ユーザマスタＩＤ');
			$table->string('dealing_kbn_cd', 2)->nullable(true)->comment('取引区分コード');
			$table->bigInteger('trn_order_receive_header_id')->unsigned()->nullable(false)->comment('受注ヘッダＩＤ');
			$table->bigInteger('trn_order_header_id')->unsigned()->nullable(false)->comment('発注ヘッダＩＤ');
			$table->bigInteger('mt_warehouse_issue_id')->unsigned()->nullable(true)->comment('倉庫マスタ出庫ＩＤ');
			$table->bigInteger('mt_warehouse_warehousing_id')->unsigned()->nullable(true)->comment('倉庫マスタ入庫ＩＤ');
			$table->bigInteger('in_out_slip_number')->nullable(true)->comment('入出庫伝票No');
			$table->string('slip_memo', 100)->nullable(true)->comment('伝票備考');
			$table->decimal('total_quantity', 5, 1)->nullable(true)->comment('合計数量');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('in_out_number', 'idx_trn_in_out_headers_01');
            $table->foreign('mt_user_id', 'foreign_trn_in_out_headers_01')->references('id')->on('mt_users');
            $table->foreign('trn_order_receive_header_id', 'foreign_trn_in_out_headers_02')->references('id')->on('trn_order_receive_headers');
            $table->foreign('trn_order_header_id', 'foreign_trn_in_out_headers_03')->references('id')->on('trn_order_headers');
            $table->foreign('mt_warehouse_issue_id', 'foreign_trn_in_out_headers_04')->references('id')->on('mt_warehouses');
            $table->foreign('mt_warehouse_warehousing_id', 'foreign_trn_in_out_headers_05')->references('id')->on('mt_warehouses');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_in_out_headers_06')->references('id')->on('mt_users');
            $table->comment('入出庫ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_in_out_headers');
    }
};
