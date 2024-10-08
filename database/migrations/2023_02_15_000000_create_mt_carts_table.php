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
        Schema::create('mt_carts', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_customer_manager_id')->unsigned()->nullable(false)->comment('得意先別担当者マスタＩＤ');
			$table->bigInteger('mt_stock_keeping_unit_id')->unsigned()->nullable(false)->comment('SKUマスタＩＤ');
			$table->integer('order_receive_quantity')->nullable(false)->comment('受注数');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_customer_manager_id', 'idx_mt_carts_01');
            $table->index('mt_stock_keeping_unit_id', 'idx_mt_carts_02');
            $table->foreign('mt_customer_manager_id', 'foreign_mt_carts_01')->references('id')->on('mt_customer_managers');
            $table->foreign('mt_stock_keeping_unit_id', 'foreign_mt_carts_02')->references('id')->on('mt_stock_keeping_units');
            $table->comment('カートマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_carts');
    }
};
