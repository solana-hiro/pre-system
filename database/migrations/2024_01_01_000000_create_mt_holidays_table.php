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
        Schema::create('mt_holidays', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->date('set_date')->nullable(false)->comment('設定日付');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mt_user_last_update_id', 'foreign_mt_holidays_01')->references('id')->on('mt_users');
            $table->comment('休日マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_holidays');
    }
};
