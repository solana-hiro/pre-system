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
        Schema::create('mt_items', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('item_cd', 9)->nullable(false)->unique()->comment('商品コード');
			$table->bigInteger('mt_supplier_id')->unsigned()->nullable(false)->comment('仕入先マスタＩＤ');
			$table->string('item_name_1', 40)->nullable(false)->comment('商品名');
			$table->string('other_part_number', 20)->nullable(true)->comment('他品番');
			$table->string('item_name_kana', 10)->nullable(true)->comment('商品名カナ');
			$table->string('unit', 4)->nullable(true)->comment('単位');
			$table->bigInteger('mt_item_class5_id')->unsigned()->nullable(true)->comment('商品分類５マスタＩＤ');
			$table->bigInteger('mt_item_class6_id')->unsigned()->nullable(true)->comment('商品分類６マスタＩＤ');
			$table->bigInteger('mt_item_class7_id')->unsigned()->nullable(true)->comment('商品分類７マスタＩＤ');
			$table->tinyInteger('item_kbn')->nullable(false)->default(0)->comment('商品区分');
			$table->tinyInteger('stock_management_kbn')->nullable(false)->default(0)->comment('在庫管理区分');
			$table->tinyInteger('non_tax_kbn')->nullable(false)->default(0)->comment('非課税区分');
			$table->bigInteger('def_tax_rate_kbns_id')->unsigned()->nullable(false)->comment('税率区分定義ＩＤ');
			$table->bigInteger('retail_price_tax_out')->nullable(true)->comment('上代単価：税抜');
			$table->bigInteger('retail_price_tax_in')->nullable(true)->comment('上代単価：税込');
			$table->bigInteger('reference_retail_tax_out')->nullable(true)->comment('参考上代：税抜');
			$table->bigInteger('reference_retail_tax_in')->nullable(true)->comment('参考上代：税込');
			$table->decimal('purchase_price_tax_out', 13, 1)->nullable(true)->comment('仕入単価：税抜');
			$table->decimal('purchase_price_tax_in', 13, 1)->nullable(true)->comment('仕入単価：税込');
			$table->decimal('cost_price', 13, 1)->nullable(true)->comment('原価単価');
			$table->decimal('profit_calculation_cost_price', 13, 1)->nullable(true)->comment('粗利算出用原価単価');
			$table->tinyInteger('name_input_kbn')->nullable(false)->default(0)->comment('名称入力区分');
			$table->tinyInteger('del_kbn')->nullable(false)->default(0)->comment('削除区分');
			$table->tinyInteger('ec_alignment_kbn')->nullable(false)->default(0)->comment('メンバーサイト連携区分');
			$table->tinyInteger('mt_member_site_item_id')->nullable(true)->comment('メンバーサイト商品マスタID');
			$table->tinyInteger('japan_post_office')->nullable(false)->default(0)->comment('日本郵政');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_supplier_id', 'idx_mt_items_01');
            $table->index('mt_item_class5_id', 'idx_mt_items_02');
            $table->index('mt_item_class6_id', 'idx_mt_items_03');
            $table->index('mt_item_class7_id', 'idx_mt_items_04');
            $table->index('mt_member_site_item_id', 'idx_mt_items_05');

            $table->foreign('mt_supplier_id', 'foreign_mt_items_01')->references('id')->on('mt_suppliers');
            $table->foreign('mt_item_class5_id', 'foreign_mt_items_02')->references('id')->on('mt_item_classes');
            $table->foreign('mt_item_class6_id', 'foreign_mt_items_03')->references('id')->on('mt_item_classes');
            $table->foreign('mt_item_class7_id', 'foreign_mt_items_04')->references('id')->on('mt_item_classes');
            $table->foreign('def_tax_rate_kbns_id', 'foreign_mt_items_05')->references('id')->on('def_tax_rate_kbns');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_items_06')->references('id')->on('mt_users');
            $table->comment('商品マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_items');
    }
};
