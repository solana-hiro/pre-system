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
        Schema::create('mt_suppliers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('supplier_cd', 6)->nullable(false)->unique()->comment('仕入先コード');
			$table->bigInteger('mt_pay_destination_id')->unsigned()->nullable(false)->comment('支払先マスタＩＤ');
			$table->string('supplier_name', 60)->nullable(false)->comment('仕入先名');
			$table->string('supplier_name_kana', 10)->nullable(true)->comment('仕入先名カナ');
			$table->tinyInteger('honorific_kbn')->nullable(false)->default(1)->comment('敬称区分');
			$table->string('post_number', 8)->nullable(true)->comment('郵便番号');
			$table->string('address', 90)->nullable(true)->comment('住所');
			$table->string('tel', 15)->nullable(true)->comment('ＴＥＬ');
			$table->string('fax', 15)->nullable(true)->comment('ＦＡＸ');
			$table->bigInteger('mt_supplier_class1_id')->unsigned()->nullable(false)->comment('仕入先分類１マスタＩＤ');
			$table->bigInteger('mt_supplier_class2_id')->unsigned()->nullable(true)->comment('仕入先分類２マスタＩＤ');
			$table->bigInteger('mt_supplier_class3_id')->unsigned()->nullable(true)->comment('仕入先分類３マスタＩＤ');
			$table->string('representative_name', 30)->nullable(true)->comment('代表者名');
			$table->string('representative_mail', 256)->nullable(true)->comment('代表者メール');
			$table->string('supplier_manager_name', 30)->nullable(true)->comment('仕入先担当者名');
			$table->string('supplier_manager_mail', 256)->nullable(true)->comment('仕入先担当者メール');
			$table->string('supplier_url', 2083)->nullable(true)->comment('仕入先ＵＲＬ');
			$table->bigInteger('mt_user_id')->unsigned()->nullable(false)->comment('ユーザマスタＩＤ');
			$table->tinyInteger('name_input_kbn')->nullable(false)->default(0)->comment('名称入力区分');
			$table->tinyInteger('del_kbn')->nullable(false)->default(0)->comment('削除区分');
			$table->bigInteger('mt_slip_kind_order_id')->unsigned()->nullable(false)->comment('伝票種別マスタ発注伝票ＩＤ');
			$table->string('supplier_memo_1', 30)->nullable(true)->comment('仕入先備考１');
			$table->string('supplier_memo_2', 30)->nullable(true)->comment('仕入先備考２');
			$table->string('supplier_memo_3', 30)->nullable(true)->comment('仕入先備考３');
			$table->string('supplier_expansion_1', 20)->nullable(true)->comment('仕入先拡張１');
			$table->string('supplier_expansion_2', 20)->nullable(true)->comment('仕入先拡張２');
			$table->string('supplier_expansion_3', 20)->nullable(true)->comment('仕入先拡張３');
			$table->string('supplier_expansion_4', 20)->nullable(true)->comment('仕入先拡張４');
			$table->string('supplier_expansion_5', 20)->nullable(true)->comment('仕入先拡張５');
			$table->date('data_decision_date')->nullable(true)->comment('データ確定日');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('supplier_cd', 'idx_mt_suppliers_01');
            $table->index('mt_pay_destination_id', 'idx_mt_suppliers_02');
            $table->index('mt_supplier_class1_id', 'idx_mt_suppliers_03');
            $table->index('mt_supplier_class2_id', 'idx_mt_suppliers_04');
            $table->index('mt_supplier_class3_id', 'idx_mt_suppliers_05');
            $table->index('mt_slip_kind_order_id', 'idx_mt_suppliers_06');
            $table->foreign('mt_pay_destination_id', 'foreign_mt_suppliers_01')->references('id')->on('mt_pay_destinations');
            $table->foreign('mt_supplier_class1_id', 'foreign_mt_suppliers_02')->references('id')->on('mt_supplier_classes');
            $table->foreign('mt_supplier_class2_id', 'foreign_mt_suppliers_03')->references('id')->on('mt_supplier_classes');
            $table->foreign('mt_supplier_class3_id', 'foreign_mt_suppliers_04')->references('id')->on('mt_supplier_classes');
            $table->foreign('mt_user_id', 'foreign_mt_suppliers_05')->references('id')->on('mt_users');
            $table->foreign('mt_slip_kind_order_id', 'foreign_mt_suppliers_06')->references('id')->on('mt_slip_kinds');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_suppliers_07')->references('id')->on('mt_users');
            $table->comment('仕入先マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_suppliers');
    }
};
