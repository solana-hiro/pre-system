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
        Schema::create('trn_order_headers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('order_number', 8)->nullable(false)->comment('発注No');
			$table->date('order_date')->nullable(true)->comment('発注日');
			$table->bigInteger('mt_user_input_id')->unsigned()->nullable(true)->comment('ユーザマスタ入力者ＩＤ');
			$table->bigInteger('mt_supplier_id')->unsigned()->nullable(true)->comment('仕入先マスタＩＤ');
			$table->bigInteger('mt_supplier_class_id')->unsigned()->nullable(true)->comment('仕入先分類マスタＩＤ');
			$table->bigInteger('mt_user_manager_id')->unsigned()->nullable(true)->comment('ユーザマスタ担当者ＩＤ');
			$table->bigInteger('def_department_id')->unsigned()->nullable(true)->comment('部門定義ＩＤ');
			$table->string('partner_number', 15)->nullable(true)->comment('相手先No');
			$table->date('specify_deadline')->nullable(true)->comment('指定納期');
			$table->tinyInteger('order_kbn')->nullable(false)->default(0)->comment('発行区分');
			$table->bigInteger('mt_slip_kind_id')->unsigned()->nullable(true)->comment('伝票種別マスタＩＤ');
			$table->bigInteger('mt_delivery_destination_id')->unsigned()->nullable(true)->comment('納品先マスタＩＤ');
			$table->bigInteger('mt_warehouse_id')->unsigned()->nullable(true)->comment('倉庫マスタＩＤ');
			$table->string('slip_memo', 100)->nullable(true)->comment('伝票備考');
			$table->decimal('quantity_total', 5, 1)->nullable(true)->comment('数量計');
			$table->bigInteger('amount_total')->nullable(true)->comment('金額計');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_number', 'idx_trn_order_headers_01');
            $table->foreign('mt_user_input_id', 'foreign_trn_order_headers_01')->references('id')->on('mt_users');
            $table->foreign('mt_supplier_id', 'foreign_trn_order_headers_02')->references('id')->on('mt_suppliers');
            $table->foreign('mt_supplier_class_id', 'foreign_trn_order_headers_03')->references('id')->on('mt_supplier_classes');
            $table->foreign('mt_user_manager_id', 'foreign_trn_order_headers_04')->references('id')->on('mt_users');
            $table->foreign('def_department_id', 'foreign_trn_order_headers_05')->references('id')->on('def_departments');
            $table->foreign('mt_slip_kind_id', 'foreign_trn_order_headers_06')->references('id')->on('mt_slip_kinds');
            $table->foreign('mt_delivery_destination_id', 'foreign_trn_order_headers_07')->references('id')->on('mt_delivery_destinations');
            $table->foreign('mt_warehouse_id', 'foreign_trn_order_headers_08')->references('id')->on('mt_warehouses');
            $table->foreign('mt_user_last_update_id', 'foreign_trn_order_headers_09')->references('id')->on('mt_users');
            $table->comment('発注ヘッダ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('trn_order_headers');
    }
};
