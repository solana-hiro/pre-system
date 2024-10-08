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
        Schema::create('mt_pay_destinations', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('pay_destination_cd', 6)->nullable(false)->unique()->comment('支払先コード');
			$table->tinyInteger('sequentially_kbn')->nullable(false)->default(0)->comment('随時区分');
			$table->string('closing_date', 2)->nullable(false)->comment('締日');
			$table->tinyInteger('closing_month')->nullable(false)->comment('締月');
			$table->string('pay_date', 2)->nullable(false)->comment('支払日');
			$table->tinyInteger('price_fraction_process')->nullable(false)->dafault(0)->comment('単価端数処理');
			$table->tinyInteger('all_amount_fraction_process')->nullable(false)->dafault(0)->comment('全額端数処理');
			$table->tinyInteger('tax_kbn')->nullable(false)->default(1)->comment('消費税：税区分');
			$table->tinyInteger('tax_calculation_standard')->nullable(false)->default(1)->comment('消費税：算出基準');
			$table->tinyInteger('tax_fraction_process_1')->nullable(false)->default(0)->comment('消費税：端数処理１');
			$table->tinyInteger('tax_fraction_process_2')->nullable(false)->default(0)->comment('消費税：端数処理２');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('pay_destination_cd', 'idx_mt_pay_destinations_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_pay_destinations_01')->references('id')->on('mt_users');
            $table->comment('支払先マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_pay_destinations');
    }
};
