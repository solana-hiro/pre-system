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
        Schema::create('mt_customer_delivery_destinations', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_customer_id')->unsigned()->nullable(false)->comment('得意先マスタＩＤ');
			$table->bigInteger('mt_delivery_destination_id')->unsigned()->nullable(false)->comment('納品先マスタＩＤ');
			$table->tinyInteger('del_kbn_customer')->nullable(false)->default(0)->comment('削除区分(得意先)');
			$table->tinyInteger('sale_decision_print_paper_flg')->nullable(false)->default(1)->comment('売上確定時印刷用紙フラグ');
			$table->bigInteger('def_arrival_date_id')->unsigned()->nullable(true)->comment('着日定義ＩＤ');
			$table->tinyInteger('direct_delivery_commission_demand_flg')->nullable(false)->default(1)->comment('直送手数料請求フラグ');
			$table->bigInteger('mt_root_id')->unsigned()->nullable(false)->comment('ルートマスタＩＤ');
			$table->bigInteger('mt_item_class_shipping_companie_id')->unsigned()->nullable(false)->comment('運送会社マスタＩＤ');
			$table->string('delivery_destination_memo_1', 30)->nullable(true)->comment('納品先備考１');
			$table->string('delivery_destination_memo_2', 30)->nullable(true)->comment('納品先備考２');
			$table->string('delivery_destination_memo_3', 30)->nullable(true)->comment('納品先備考３');
			$table->tinyInteger('ec_display_flg')->nullable(false)->default(0)->comment('ＥＣ表示フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_customer_id', 'idx_mt_customer_delivery_destinations_01');
            $table->index('mt_delivery_destination_id', 'idx_mt_customer_delivery_destinations_02');
            $table->index('mt_root_id', 'idx_mt_customer_delivery_destinations_03');
            $table->index('mt_item_class_shipping_companie_id', 'idx_mt_customer_delivery_destinations_04');
            $table->foreign('mt_customer_id', 'foreign_mt_customer_delivery_destinations_01')->references('id')->on('mt_customers');
            $table->foreign('mt_delivery_destination_id', 'foreign_mt_customer_delivery_destinations_02')->references('id')->on('mt_delivery_destinations');
            $table->foreign('def_arrival_date_id', 'foreign_mt_customer_delivery_destinations_03')->references('id')->on('def_arrival_dates');
            $table->foreign('mt_root_id', 'foreign_mt_customer_delivery_destinations_04')->references('id')->on('mt_roots');
            $table->foreign('mt_item_class_shipping_companie_id', 'foreign_mt_customer_delivery_destinations_05')->references('id')->on('mt_item_classes');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_customer_delivery_destinations_06')->references('id')->on('mt_users');
            $table->comment('得意先別納品先マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_customer_delivery_destinations');
    }
};
