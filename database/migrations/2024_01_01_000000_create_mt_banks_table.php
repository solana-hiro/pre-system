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
        Schema::create('mt_banks', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('bank_cd', 4)->nullable(false)->unique()->comment('銀行コード');
			$table->string('bank_name', 20)->nullable(false)->comment('銀行名');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('bank_cd', 'idx_mt_banks_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_banks_01')->references('id')->on('mt_users');
            $table->comment('銀行マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_banks');
    }
};
