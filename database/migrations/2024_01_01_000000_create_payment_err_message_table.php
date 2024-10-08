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
        Schema::create('payment_err_message', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('err_code', 3)->nullable(false)->comment('エラーコード');
			$table->string('err_info', 9)->nullable(false)->comment('エラー詳細コード');
			$table->string('err_message', 200)->nullable(true)->comment('エラーメッセージ');
			$table->string('err_message_detail', 200)->nullable(true)->comment('エラー内容と加盟店側対処方法');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('決済エラーメッセージマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('payment_err_message');
    }
};
