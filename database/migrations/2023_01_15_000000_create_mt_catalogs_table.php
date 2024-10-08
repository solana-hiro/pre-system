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
        Schema::create('mt_catalogs', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('catalog_cd', 4)->nullable(false)->unique()->comment('カタログコード');
			$table->string('catalog_name', 100)->nullable(false)->comment('カタログ名');
			$table->dateTime('release_start_datetime')->nullable(true)->comment('公開開始日時');
			$table->dateTime('release_end_datetime')->nullable(true)->comment('公開終了日時');
			$table->tinyInteger('display_flg')->nullable(false)->default(0)->comment('表示フラグ');
			$table->string('display_sort_order', 3)->nullable(true)->comment('表示順');
			$table->string('image_file', 256)->nullable(false)->comment('画像ファイル');
			$table->string('catalog_explanation', 3000)->nullable(false)->comment('カタログ説明');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('catalog_cd', 'idx_mt_catalogs_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_catalogs_01')->references('id')->on('mt_users');
            $table->comment('カタログマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_catalogs');
    }
};
