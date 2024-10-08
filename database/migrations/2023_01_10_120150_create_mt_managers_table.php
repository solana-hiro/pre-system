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
        Schema::create('mt_managers', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('manager_cd', 4)->nullable(false)->unique()->comment('担当者コード');
			$table->string('manager_name', 30)->nullable(false)->comment('担当者名');
			$table->string('manager_mail', 256)->nullable(false)->comment('担当者メールアドレス');
			$table->string('ec_login_id', 6)->nullable(false)->comment('ＥＣログインＩＤ');
			$table->string('ec_login_password', 64)->nullable(false)->comment('ＥＣログインパスワード');
			$table->dateTime('ec_password_issue_mail_last_send_datetime')->nullable(true)->comment('ＥＣパスワード発行メール最終送信日時');
			$table->tinyInteger('validity_flg')->nullable(false)->default(1)->comment('有効フラグ 0：無効、1：有効');
			$table->string('display_order', 3)->nullable(false)->comment('表示順');
			$table->string('memo', 200)->nullable(true)->comment('備考');
			$table->dateTime('register_datetime')->nullable(true)->comment('登録日');
			$table->dateTime('ec_password_reset_mail_last_send_datetime')->nullable(true)->comment('ＥＣパスワードリセットメール最終送信日時');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mt_user_last_update_id', 'foreign_mt_managers_01')->references('id')->on('mt_users');
            $table->comment('担当者マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_managers');
    }
};
