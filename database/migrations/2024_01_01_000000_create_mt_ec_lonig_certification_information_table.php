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
        Schema::create('mt_ec_login_certification_information', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('user_id', 100)->nullable(true)->comment('ユーザーID');
			$table->string('certification_key', 255)->nullable(true)->comment('認証キー');
			$table->string('ip_address', 15)->nullable(true)->comment('IPアドレス');
			$table->string('user_http_information', 255)->nullable(true)->comment('ユーザーHTTP情報');
			$table->date('date')->nullable(true)->comment('利用日');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id', 'idx_mt_ec_login_certification_information_01');
            $table->index('certification_key', 'idx_mt_ec_login_certification_information_02');
            $table->index('ip_address', 'idx_mt_ec_login_certification_information_03');
            $table->comment('ECログイン認証情報');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_ec_login_certification_information');
    }
};
