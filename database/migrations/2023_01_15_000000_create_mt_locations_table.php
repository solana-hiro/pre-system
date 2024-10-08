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
        Schema::create('mt_locations', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_warehouse_id')->unsigned()->nullable(false)->comment('倉庫マスタＩＤ');
			$table->bigInteger('mt_stock_keeping_unit_id')->unsigned()->nullable(false)->comment('SKUマスタＩＤ');
			$table->string('shelf_number_1', 10)->nullable(false)->comment('棚番１');
			$table->string('shelf_number_2', 10)->nullable(true)->comment('棚番２');
			$table->string('rank', 2)->nullable(true)->comment('ランク');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_warehouse_id', 'idx_mt_locations_01');
            $table->foreign('mt_warehouse_id', 'foreign_mt_locations_01')->references('id')->on('mt_warehouses');
            $table->foreign('mt_stock_keeping_unit_id', 'foreign_mt_locations_02')->references('id')->on('mt_items');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_locations_03')->references('id')->on('mt_users');
            $table->comment('ロケーションマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_locations');
    }
};
