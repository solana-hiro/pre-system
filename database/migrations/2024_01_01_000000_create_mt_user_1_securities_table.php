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
        Schema::create('mt_user_1_securities', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_user_id')->unsigned()->nullable(false)->comment('ユーザマスタＩＤ');
			$table->bigInteger('def_1_menu_id')->unsigned()->nullable(false)->comment('メニュー１定義ＩＤ');
			$table->tinyInteger('auth_use_flg')->nullable(false)->default(0)->comment('権限：使用フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_user_id', 'idx_mt_user_1_securities_01');
            $table->index('def_1_menu_id', 'idx_mt_user_1_securities_02');
            $table->index('auth_use_flg', 'idx_mt_user_1_securities_03');
            $table->foreign('mt_user_id', 'foreign_mt_user_1_securities_01')->references('id')->on('mt_users');
            $table->foreign('def_1_menu_id', 'foreign_mt_user_1_securities_02')->references('id')->on('def_1_menus');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_user_1_securities_03')->references('id')->on('mt_users');
            $table->comment('ユーザセキュリティ１マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_user_1_securities');
    }
};
