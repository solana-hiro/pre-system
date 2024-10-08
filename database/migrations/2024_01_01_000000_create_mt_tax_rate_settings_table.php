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
        Schema::create('mt_tax_rate_settings', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('def_tax_rate_kbn_id')->unsigned()->nullable(false)->comment('税率区分定義ＩＤ');
			$table->date('application_start_date')->nullable(false)->comment('適用開始日');
			$table->decimal('tax_rate', 4, 2)->nullable(false)->comment('税率');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('def_tax_rate_kbn_id', 'idx_mt_tax_rate_settings_01');
            $table->foreign('def_tax_rate_kbn_id', 'foreign_mt_tax_rate_settings_01')->references('id')->on('def_tax_rate_kbns');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_tax_rate_settings_02')->references('id')->on('mt_users');
            $table->comment('税率設定マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_tax_rate_settings');
    }
};
