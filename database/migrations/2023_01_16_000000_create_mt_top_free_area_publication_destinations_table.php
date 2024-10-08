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
        Schema::create('mt_top_free_area_publication_destinations', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->bigInteger('mt_top_free_area_id')->unsigned()->nullable(false)->comment('TOP自由領域マスタID');
			$table->string('public_classification', 1)->nullable(false)->comment('公開分類');
			$table->bigInteger('mt_publication_destination_id')->nullable(true)->comment('公開先マスタID');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_top_free_area_id', 'idx_mt_top_free_area_publication_destinations_01');
            $table->foreign('mt_top_free_area_id', 'foreign_mt_top_free_area_publication_destinations_01')->references('id')->on('mt_top_free_areas');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_top_free_area_publication_destinations_02')->references('id')->on('mt_users');
            $table->comment('TOP自由領域公開先マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_top_free_area_publication_destinations');
    }
};
