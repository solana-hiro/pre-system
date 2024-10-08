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
        Schema::create('mt_sizes', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('size_cd', 4)->nullable(false)->unique()->comment('サイズコード');
			$table->string('size_name', 10)->nullable(true)->comment('サイズ名');
			$table->string('sort_order', 3)->nullable(false)->comment('並び順');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('size_cd', 'idx_mt_sizes_01');
            $table->index('sort_order', 'idx_mt_sizes_02');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_sizes_01')->references('id')->on('mt_users');
            $table->comment('サイズマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_sizes');
    }
};
