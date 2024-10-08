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
        Schema::create('mt_size_patterns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('size_pattern_cd', 4)->nullable(false)->unique()->comment('サイズパターンコード');
			$table->bigInteger('mt_size_id_1')->unsigned()->nullable(true)->comment('サイズマスタＩＤ１');
			$table->bigInteger('mt_size_id_2')->unsigned()->nullable(true)->comment('サイズマスタＩＤ２');
			$table->bigInteger('mt_size_id_3')->unsigned()->nullable(true)->comment('サイズマスタＩＤ３');
			$table->bigInteger('mt_size_id_4')->unsigned()->nullable(true)->comment('サイズマスタＩＤ４');
			$table->bigInteger('mt_size_id_5')->unsigned()->nullable(true)->comment('サイズマスタＩＤ５');
			$table->bigInteger('mt_size_id_6')->unsigned()->nullable(true)->comment('サイズマスタＩＤ６');
			$table->bigInteger('mt_size_id_7')->unsigned()->nullable(true)->comment('サイズマスタＩＤ７');
			$table->bigInteger('mt_size_id_8')->unsigned()->nullable(true)->comment('サイズマスタＩＤ８');
			$table->bigInteger('mt_size_id_9')->unsigned()->nullable(true)->comment('サイズマスタＩＤ９');
			$table->bigInteger('mt_size_id_10')->unsigned()->nullable(true)->comment('サイズマスタＩＤ１０');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('size_pattern_cd', 'idx_mt_size_patterns_01');
            $table->index('mt_size_id_1', 'idx_mt_size_patterns_02');
            $table->index('mt_size_id_2', 'idx_mt_size_patterns_03');
            $table->index('mt_size_id_3', 'idx_mt_size_patterns_04');
            $table->index('mt_size_id_4', 'idx_mt_size_patterns_05');
            $table->index('mt_size_id_5', 'idx_mt_size_patterns_06');
            $table->index('mt_size_id_6', 'idx_mt_size_patterns_07');
            $table->index('mt_size_id_7', 'idx_mt_size_patterns_08');
            $table->index('mt_size_id_8', 'idx_mt_size_patterns_09');
            $table->index('mt_size_id_9', 'idx_mt_size_patterns_10');
            $table->index('mt_size_id_10', 'idx_mt_size_patterns_11');
            $table->foreign('mt_size_id_1', 'foreign_mt_size_patterns_01')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_2', 'foreign_mt_size_patterns_02')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_3', 'foreign_mt_size_patterns_03')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_4', 'foreign_mt_size_patterns_04')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_5', 'foreign_mt_size_patterns_05')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_6', 'foreign_mt_size_patterns_06')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_7', 'foreign_mt_size_patterns_07')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_8', 'foreign_mt_size_patterns_08')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_9', 'foreign_mt_size_patterns_09')->references('id')->on('mt_sizes');
            $table->foreign('mt_size_id_10', 'foreign_mt_size_patterns_10')->references('id')->on('mt_sizes');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_size_patterns_11')->references('id')->on('mt_users');
            $table->comment('サイズパターンマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_size_patterns');
    }
};
