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
        Schema::create('mt_shipping_companies', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('shipping_company_cd', 4)->nullable(false)->unique()->comment('運送会社コード');
			$table->string('shipping_company_name', 20)->nullable(false)->comment('運送会社名');
			$table->bigInteger('mt_slip_kind7_id')->unsigned()->nullable(false)->comment('伝票種別7マスタＩＤ');
			$table->bigInteger('mt_slip_kind17_id')->unsigned()->nullable(true)->comment('伝票種別17マスタＩＤ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('shipping_company_cd', 'idx_mt_shipping_companies_01');
            $table->foreign('mt_slip_kind7_id', 'foreign_mt_shipping_companies_01')->references('id')->on('mt_slip_kinds');
            $table->foreign('mt_slip_kind17_id', 'foreign_mt_shipping_companies_02')->references('id')->on('mt_slip_kinds');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_shipping_companies_03')->references('id')->on('mt_users');
            $table->comment('得意先別納品先マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_shipping_companies');
    }
};
