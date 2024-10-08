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
        Schema::create('mt_customer_managers', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->bigInteger('mt_customer_id')->unsigned()->nullable(false)->comment('得意先マスタＩＤ');
			$table->bigInteger('mt_manager_id')->unsigned()->nullable(false)->comment('担当者マスタＩＤ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_customer_id', 'idx_customer_managers_01');
            $table->index('mt_manager_id', 'idx_customer_managers_02');
            $table->foreign('mt_customer_id', 'foreign_mt_customer_managers_01')->references('id')->on('mt_customers');
            $table->foreign('mt_manager_id', 'foreign_mt_customer_managers_02')->references('id')->on('mt_managers');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_customer_managers_03')->references('id')->on('mt_users');
            $table->comment('担当者マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_customer_managers');
    }
};
