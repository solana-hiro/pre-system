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
        Schema::create('mt_thing_names', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('item_class_1_label', 10)->nullable(false)->comment('商品分類１ラベル');
			$table->string('item_class_2_label', 10)->nullable(false)->comment('商品分類２ラベル');
			$table->string('item_class_3_label', 10)->nullable(false)->comment('商品分類３ラベル');
			$table->string('item_class_4_label', 10)->nullable(false)->comment('商品分類４ラベル');
			$table->string('item_class_5_label', 10)->nullable(false)->comment('商品分類５ラベル');
			$table->string('item_class_6_label', 10)->nullable(false)->comment('商品分類６ラベル');
			$table->string('item_class_7_label', 10)->nullable(false)->comment('商品分類７ラベル');
			$table->string('customer_memo_1_label', 10)->nullable(false)->comment('得意先備考１ラベル');
			$table->string('customer_memo_2_label', 10)->nullable(false)->comment('得意先備考２ラベル');
			$table->string('customer_memo_3_label', 10)->nullable(false)->comment('得意先備考３ラベル');
			$table->string('nouhinsaki_memo_1_label', 10)->nullable(false)->comment('納品先備考１ラベル');
			$table->string('nouhinsaki_memo_2_label', 10)->nullable(false)->comment('納品先備考２ラベル');
			$table->string('nouhinsaki_memo_3_label', 10)->nullable(false)->comment('納品先備考３ラベル');
			$table->string('supplier_memo_1_label', 10)->nullable(false)->comment('仕入先備考１ラベル');
			$table->string('supplier_memo_2_label', 10)->nullable(false)->comment('仕入先備考２ラベル');
			$table->string('supplier_memo_3_label', 10)->nullable(false)->comment('仕入先備考３ラベル');
			$table->string('item_memo_1_label', 10)->nullable(false)->comment('商品備考１ラベル');
			$table->string('item_memo_2_label', 10)->nullable(false)->comment('商品備考２ラベル');
			$table->string('item_memo_3_label', 10)->nullable(false)->comment('商品備考３ラベル');
			$table->string('item_memo_4_label', 10)->nullable(false)->comment('商品備考４ラベル');
			$table->string('item_memo_5_label', 10)->nullable(false)->comment('商品備考５ラベル');
			$table->string('customer_expansion_thing_1_label', 10)->nullable(false)->comment('得意先拡張項目１ラベル');
			$table->string('customer_expansion_thing_2_label', 10)->nullable(false)->comment('得意先拡張項目２ラベル');
			$table->string('customer_expansion_thing_3_label', 10)->nullable(false)->comment('得意先拡張項目３ラベル');
			$table->string('customer_expansion_thing_4_label', 10)->nullable(false)->comment('得意先拡張項目４ラベル');
			$table->string('customer_expansion_thing_5_label', 10)->nullable(false)->comment('得意先拡張項目５ラベル');
			$table->string('supplier_expansion_thing_1_label', 10)->nullable(false)->comment('仕入先拡張項目１ラベル');
			$table->string('supplier_expansion_thing_2_label', 10)->nullable(false)->comment('仕入先拡張項目２ラベル');
			$table->string('supplier_expansion_thing_3_label', 10)->nullable(false)->comment('仕入先拡張項目３ラベル');
			$table->string('supplier_expansion_thing_4_label', 10)->nullable(false)->comment('仕入先拡張項目４ラベル');
			$table->string('supplier_expansion_thing_5_label', 10)->nullable(false)->comment('仕入先拡張項目５ラベル');
			$table->string('quantity_label', 10)->nullable(false)->comment('入数ラベル');
			$table->string('case_quantity_label', 10)->nullable(false)->comment('ケース数ラベル');
			$table->string('cs_1_label', 10)->nullable(false)->comment('ＣＳ１ラベル');
			$table->string('cs_2_label', 10)->nullable(false)->comment('ＣＳ２ラベル');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mt_user_last_update_id', 'foreign_mt_thing_names_01')->references('id')->on('mt_users');
            $table->comment('項目名マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_thing_names');
    }
};
