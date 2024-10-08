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
        Schema::create('mt_notices', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('notice_cd', 4)->nullable(false)->unique()->comment('お知らせコード');
			$table->string('title', 100)->nullable(false)->comment('タイトル');
			$table->tinyInteger('news_kind')->nullable(false)->default(0)->comment('ニュース種別');
			$table->string('notice_content', 3000)->nullable(true)->comment('お知らせ内容');
			$table->dateTime('release_start_datetime')->nullable(true)->comment('公開開始日時');
			$table->dateTime('release_end_datetime')->nullable(true)->comment('公開終了日時');
			$table->string('image_file', 256)->nullable(true)->comment('画像ファイル');
			$table->string('pdf_file_1', 256)->nullable(true)->comment('PDFファイル1');
			$table->string('pdf_file_2', 256)->nullable(true)->comment('PDFファイル2');
			$table->string('pdf_file_3', 256)->nullable(true)->comment('PDFファイル3');
			$table->string('pdf_file_4', 256)->nullable(true)->comment('PDFファイル4');
			$table->string('pdf_file_5', 256)->nullable(true)->comment('PDFファイル5');
			$table->tinyInteger('display_flg')->nullable(false)->default(0)->comment('表示フラグ');
			$table->string('display_sort_order', 3)->nullable(false)->comment('表示順');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('notice_cd', 'idx_mt_notices_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_notices_01')->references('id')->on('mt_users');
            $table->comment('お知らせマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_notices');
    }
};
