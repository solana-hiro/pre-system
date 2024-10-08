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
        Schema::create('mt_top_free_areas', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('area_cd', 4)->nullable(false)->unique()->comment('領域コード');
			$table->string('area_title', 100)->nullable(false)->comment('領域タイトル');
			$table->tinyInteger('setting_position')->nullable(false)->default(0)->comment('設定位置');
			$table->string('content', 3000)->nullable(true)->comment('内容');
			$table->string('image_file', 256)->nullable(true)->comment('画像ファイル');
			$table->string('pdf_file', 256)->nullable(true)->comment('PDFファイル');
			$table->dateTime('release_start_datetime')->nullable(true)->comment('公開開始日時');
			$table->dateTime('release_end_datetime')->nullable(true)->comment('公開終了日時');
			$table->tinyInteger('display_flg')->nullable(false)->default(0)->comment('表示フラグ');
			$table->string('display_sort_order', 3)->nullable(false)->comment('表示順');
			$table->tinyInteger('publication_destination_flg')->nullable(false)->default(0)->comment('公開先フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('area_cd', 'idx_mt_top_free_areas_01');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_top_free_areas_01')->references('id')->on('mt_users');
            $table->comment('TOP自由領域マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_top_free_areas');
    }
};
