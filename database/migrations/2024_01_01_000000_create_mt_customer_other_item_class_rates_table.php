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
        Schema::create('mt_customer_other_item_class_rates', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_customer_id')->unsigned()->nullable(true)->unique()->comment('得意先マスタＩＤ');
			$table->bigInteger('mt_item_class_id')->unsigned()->nullable(false)->comment('商品分類マスタＩＤ');
			$table->tinyInteger('rate')->nullable(false)->comment('掛率');
			$table->date('start_date', 4)->nullable(false)->comment('開始日付');
			$table->date('end_date', 4)->nullable(true)->comment('終了日付');
			$table->tinyInteger('old_rate')->nullable(true)->comment('旧掛率');
			$table->date('old_start_date')->nullable(true)->comment('旧開始日付');
			$table->date('old_end_date')->nullable(true)->comment('旧終了日付');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mt_customer_id', 'foreign_mt_customer_other_item_class_rates_01')->references('id')->on('mt_customers');
            $table->foreign('mt_item_class_id', 'foreign_mt_customer_other_item_class_rates_02')->references('id')->on('mt_item_classes');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_customer_other_item_class_rates_03')->references('id')->on('mt_users');
            $table->comment('得意先別商品分類掛率マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_customer_other_item_class_rates');
    }
};
