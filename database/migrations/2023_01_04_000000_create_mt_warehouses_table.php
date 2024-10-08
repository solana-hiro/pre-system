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
        Schema::create('mt_warehouses', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('warehouse_cd', 6)->nullable(false)->comment('倉庫コード');
			$table->string('warehouse_name', 20)->nullable(true)->comment('倉庫名');
			$table->string('warehouse_name_kana', 10)->nullable(true)->comment('倉庫名カナ');
			$table->tinyInteger('warehouse_kind')->nullable(false)->comment('倉庫種別');
			$table->tinyInteger('analysis_warehouse_kbn')->nullable(false)->comment('分析用各倉庫区分');
			$table->tinyInteger('asset_stock_validity_kbn')->nullable(false)->comment('資産在庫有効区分');
			$table->tinyInteger('del_kbn')->nullable(false)->comment('削除区分');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('warehouse_cd', 'idx__mt_warehouses_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_warehouses_01')->references('id')->on('mt_users');
            $table->comment('倉庫マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_warehouses');
    }
};
