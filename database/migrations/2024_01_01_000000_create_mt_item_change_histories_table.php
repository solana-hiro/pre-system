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
        Schema::create('mt_item_change_histories', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('mt_item_id')->unsigned()->nullable(false)->comment('商品マスタＩＤ');
			$table->bigInteger('mt_user_id')->unsigned()->nullable(false)->comment('ユーザマスタＩＤ');
			$table->datetime('change_datetime', 4)->nullable(false)->comment('変更日時');
			$table->bigInteger('def_item_change_history_thing_id')->unsigned()->nullable(false)->comment('商品変更履歴項目定義ID');
			$table->string('change_before', 256)->nullable(true)->comment('変更前');
			$table->string('change_after', 256)->nullable(true)->comment('変更後');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_item_id', 'idx_mt_item_change_histories_01');
            $table->foreign('mt_item_id', 'foreign_mt_item_change_histories_01')->references('id')->on('mt_items');
            $table->foreign('mt_user_id', 'foreign_mt_item_change_histories_02')->references('id')->on('mt_users');
            $table->foreign('def_item_change_history_thing_id', 'foreign_mt_item_change_histories_03')->references('id')->on('def_item_change_history_things');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_item_change_histories_04')->references('id')->on('mt_users');
            $table->comment('商品変更履歴マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_item_change_histories');
    }
};
