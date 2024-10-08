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
        Schema::create('password_token', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->bigInteger('mt_manager_id')->unsigned()->nullable(false)->unique()->comment('担当者マスタＩＤ');
			$table->string('token', 255)->nullable(false)->comment('トークン');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_manager_id', 'idx_password_token_01');
            $table->foreign('mt_manager_id', 'foreign_password_token_01')->references('id')->on('mt_managers');
            $table->comment('パスワードトークン');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('password_token');
    }
};
