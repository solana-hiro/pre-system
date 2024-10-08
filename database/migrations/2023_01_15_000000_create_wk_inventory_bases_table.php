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
        Schema::create('wk_inventory_bases', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->date('inventory_date')->nullable(false)->comment('棚卸日');
			$table->bigInteger('mt_warehouse_id')->unsigned()->nullable(false)->comment('倉庫マスタＩＤ');
			$table->bigInteger('mt_item_class_id')->unsigned()->nullable(false)->comment('商品分類マスタＩＤ');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(false)->comment('商品マスタＩＤ');
			$table->bigInteger('mt_color_id')->unsigned()->nullable(false)->comment('カラーマスタＩＤ');
			$table->bigInteger('mt_size_id')->unsigned()->nullable(false)->comment('サイズマスタＩＤ');
			$table->bigInteger('mt_location_id')->unsigned()->nullable(false)->comment('ロケーションマスタＩＤ');
			$table->integer('stock_quantity')->nullable(true)->comment('在庫数量');
			$table->bigInteger('stock_price')->nullable(true)->comment('在庫単価');
			$table->bigInteger('stock_amount')->nullable(true)->comment('在庫金額');
			$table->bigInteger('retail_price_tax_out')->nullable(true)->comment('上代単価：税抜');
			$table->bigInteger('retail_amount')->nullable(true)->comment('上代金額');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_warehouse_id', 'idx_wk_inventory_bases_01');
            $table->foreign('mt_warehouse_id', 'foreign_wk_inventory_bases_01')->references('id')->on('mt_warehouses');
            $table->foreign('mt_item_class_id', 'foreign_wk_inventory_bases_02')->references('id')->on('mt_item_classes');
            $table->foreign('mt_item_id', 'foreign_wk_inventory_bases_03')->references('id')->on('mt_items');
            $table->foreign('mt_color_id', 'foreign_wk_inventory_bases_04')->references('id')->on('mt_colors');
            $table->foreign('mt_size_id', 'foreign_wk_inventory_bases_05')->references('id')->on('mt_sizes');
            $table->foreign('mt_location_id', 'foreign_wk_inventory_bases_06')->references('id')->on('mt_locations');
            $table->foreign('mt_user_last_update_id', 'foreign_wk_inventory_bases_07')->references('id')->on('mt_users');
            $table->comment('棚卸ベースワーク');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('wk_inventory_bases');
    }
};
