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
        Schema::create('mt_users', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('user_cd', 4)->nullable(false)->unique()->comment('ユーザコード');
			$table->string('user_name', 20)->nullable(false)->comment('ユーザ名');
			$table->string('user_name_kana', 10)->nullable(false)->comment('ユーザ名カナ');
			$table->string('password', 64)->nullable(false)->comment('パスワード');
			$table->string('mail', 256)->nullable(true)->comment('メール');
			$table->bigInteger('def_department_id')->unsigned()->nullable(false)->comment('部門定義ＩＤ');
			$table->tinyInteger('sp_auth_price_correction_possible')->nullable(false)->default(0)->comment('特殊権限「単価訂正可能」 0：不可能、1：可能');
			$table->tinyInteger('sp_auth_star_none_possible')->nullable(false)->default(0)->comment('特殊権限「★無し可能」 0：不可能、1：可能');
			$table->tinyInteger('sp_auth_hand_inspection_possible')->nullable(false)->default(0)->comment('特殊権限「手検品可能」 0：不可能、1：可能');
			$table->tinyInteger('validity_flg')->nullable(false)->default(0)->comment('有効フラグ 0：無効、1：有効');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_cd', 'idx_mt_users_01');
            $table->index('user_name', 'idx_mt_users_02');
            $table->index('user_name_kana', 'idx_mt_users_03');
            $table->index('password', 'idx_mt_users_04');
            $table->index('def_department_id', 'idx_mt_users_05');
            $table->index('sp_auth_price_correction_possible', 'idx_mt_users_06');
            $table->index('sp_auth_star_none_possible', 'idx_mt_users_07');
            $table->index('sp_auth_hand_inspection_possible', 'idx_mt_users_08');
            $table->index('validity_flg', 'idx_mt_users_09');
            $table->foreign('def_department_id', 'foreign_mt_users_01')->references('id')->on('def_departments');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_users_02')->references('id')->on('mt_users');
            $table->comment('ユーザマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_users');
    }
};
