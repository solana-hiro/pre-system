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
        Schema::create('mt_supplier_item_prices', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_supplier_id')->unsigned()->nullable(false)->comment('仕入先マスタＩＤ');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(false)->comment('商品マスタＩＤ');
			$table->date('set_date')->nullable(false)->comment('設定日付');
			$table->decimal('price', 13, 1)->nullable(false)->comment('単価');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_supplier_id', 'idx_mt_supplier_item_prices_01');
            $table->foreign('mt_supplier_id', 'foreign_mt_supplier_item_prices_01')->references('id')->on('mt_suppliers');
            $table->foreign('mt_item_id', 'foreign_mt_supplier_item_prices_02')->references('id')->on('mt_items');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_supplier_item_prices_03')->references('id')->on('mt_users');
            $table->comment('仕入先商品単価マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_supplier_item_prices');
    }
};
