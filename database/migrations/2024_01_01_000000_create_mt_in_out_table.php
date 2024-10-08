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
        Schema::create('mt_in_out', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('in_out_cd', 2)->nullable(false)->unique()->comment('入出庫区分コード');
			$table->string('in_out_name', 10)->nullable(true)->comment('入出庫区分名');
			$table->string('sort_order', 3)->nullable(false)->comment('並び順');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('in_out_cd', 'idx_mt_in_out_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_in_out_01')->references('id')->on('mt_users');
            $table->comment('入出庫区分マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_in_out');
    }
};
