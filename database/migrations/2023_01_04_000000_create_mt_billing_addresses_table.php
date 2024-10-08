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
        Schema::create('mt_billing_addresses', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('billing_address_cd', 6)->nullable(false)->unique()->comment('請求先コード');
			$table->tinyInteger('sequentially_kbn')->nullable(false)->default(0)->comment('随時区分');
			$table->string('closing_date_1', 2)->nullable(false)->comment('締日１');
			$table->string('closing_date_2', 2)->nullable(true)->comment('締日２');
			$table->string('closing_date_3', 3)->nullable()->comment('締日３');
			$table->tinyInteger('collect_month_1')->nullable(false)->comment('回収月１');
			$table->tinyInteger('collect_month_2')->nullable(true)->comment('回収月２');
			$table->tinyInteger('collect_month_3')->nullable(true)->comment('回収月３');
			$table->string('collect_date_1', 2)->nullable(false)->comment('回収日１');
			$table->string('collect_date_2', 2)->nullable(true)->comment('回収日２');
			$table->string('collect_date_3', 2)->nullable(true)->comment('回収日３');
			$table->integer('collect_amount_3')->nullable(true)->comment('3ヶ月前');
			$table->integer('collect_amount_2')->nullable(true)->comment('2ヶ月前');
			$table->integer('collect_amount_1')->nullable(true)->comment('1ヶ月前');
			$table->integer('credit_limit_amount')->nullable(false)->comment('与信限度額');
			$table->integer('credit_amount')->nullable(false)->comment('与信額');
			$table->tinyInteger('price_fraction_process')->nullable(false)->default(0)->comment('単価端数処理');
			$table->tinyInteger('all_amount_fraction_process')->nullable(false)->default(0)->comment('全額端数処理');
			$table->tinyInteger('tax_kbn')->nullable(false)->default(1)->comment('消費税：税区分');
			$table->tinyInteger('tax_calculation_standard')->nullable(false)->default(1)->comment('消費税：算出基準');
			$table->tinyInteger('tax_fraction_process_yen')->nullable(false)->default(0)->comment('消費税：端数処理（円）');
			$table->tinyInteger('tax_fraction_process')->nullable(false)->default(0)->comment('消費税：端数処理');
			$table->tinyInteger('invoice_mailing_flg')->nullable(false)->default(1)->comment('請求書郵送要不要フラグ');
			$table->tinyInteger('invoice_kind_flg')->nullable(false)->default(1)->comment('請求書種別フラグ');
			$table->tinyInteger('sale_decision_print_paper_flg')->nullable(false)->default(1)->comment('売上確定時印刷用紙フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('billing_address_cd', 'idx_mt_billing_addresses_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_billing_addresses_01')->references('id')->on('mt_users');
            $table->comment('請求先マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_billing_addresses');
    }
};
