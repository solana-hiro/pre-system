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
        Schema::create('mt_color_patterns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('color_pattern_cd', 4)->nullable(false)->unique()->comment('カラーパターンコード');
			$table->bigInteger('mt_color_id_1')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１');
			$table->bigInteger('mt_color_id_2')->unsigned()->nullable(true)->comment('カラーマスタＩＤ２');
			$table->bigInteger('mt_color_id_3')->unsigned()->nullable(true)->comment('カラーマスタＩＤ３');
			$table->bigInteger('mt_color_id_4')->unsigned()->nullable(true)->comment('カラーマスタＩＤ４');
			$table->bigInteger('mt_color_id_5')->unsigned()->nullable(true)->comment('カラーマスタＩＤ５');
			$table->bigInteger('mt_color_id_6')->unsigned()->nullable(true)->comment('カラーマスタＩＤ６');
			$table->bigInteger('mt_color_id_7')->unsigned()->nullable(true)->comment('カラーマスタＩＤ７');
			$table->bigInteger('mt_color_id_8')->unsigned()->nullable(true)->comment('カラーマスタＩＤ８');
			$table->bigInteger('mt_color_id_9')->unsigned()->nullable(true)->comment('カラーマスタＩＤ９');
			$table->bigInteger('mt_color_id_10')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１０');
			$table->bigInteger('mt_color_id_11')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１１');
			$table->bigInteger('mt_color_id_12')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１２');
			$table->bigInteger('mt_color_id_13')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１３');
			$table->bigInteger('mt_color_id_14')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１４');
			$table->bigInteger('mt_color_id_15')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１５');
			$table->bigInteger('mt_color_id_16')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１６');
			$table->bigInteger('mt_color_id_17')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１７');
			$table->bigInteger('mt_color_id_18')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１８');
			$table->bigInteger('mt_color_id_19')->unsigned()->nullable(true)->comment('カラーマスタＩＤ１９');
			$table->bigInteger('mt_color_id_20')->unsigned()->nullable(true)->comment('カラーマスタＩＤ２０');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('color_pattern_cd', 'idx_mt_color_patterns_01');
            $table->index('mt_color_id_1', 'idx_mt_color_patterns_02');
            $table->index('mt_color_id_2', 'idx_mt_color_patterns_03');
            $table->index('mt_color_id_3', 'idx_mt_color_patterns_04');
            $table->index('mt_color_id_4', 'idx_mt_color_patterns_05');
            $table->index('mt_color_id_5', 'idx_mt_color_patterns_06');
            $table->index('mt_color_id_6', 'idx_mt_color_patterns_07');
            $table->index('mt_color_id_7', 'idx_mt_color_patterns_08');
            $table->index('mt_color_id_8', 'idx_mt_color_patterns_09');
            $table->index('mt_color_id_9', 'idx_mt_color_patterns_10');
            $table->index('mt_color_id_10', 'idx_mt_color_patterns_11');
            $table->index('mt_color_id_11', 'idx_mt_color_patterns_12');
            $table->index('mt_color_id_12', 'idx_mt_color_patterns_13');
            $table->index('mt_color_id_13', 'idx_mt_color_patterns_14');
            $table->index('mt_color_id_14', 'idx_mt_color_patterns_15');
            $table->index('mt_color_id_15', 'idx_mt_color_patterns_16');
            $table->index('mt_color_id_16', 'idx_mt_color_patterns_17');
            $table->index('mt_color_id_17', 'idx_mt_color_patterns_18');
            $table->index('mt_color_id_18', 'idx_mt_color_patterns_19');
            $table->index('mt_color_id_19', 'idx_mt_color_patterns_20');
            $table->index('mt_color_id_20', 'idx_mt_color_patterns_21');

            $table->foreign('mt_color_id_1', 'foreign_mt_color_patterns_01')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_2', 'foreign_mt_color_patterns_02')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_3', 'foreign_mt_color_patterns_03')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_4', 'foreign_mt_color_patterns_04')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_5', 'foreign_mt_color_patterns_05')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_6', 'foreign_mt_color_patterns_06')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_7', 'foreign_mt_color_patterns_07')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_8', 'foreign_mt_color_patterns_08')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_9', 'foreign_mt_color_patterns_09')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_10', 'foreign_mt_color_patterns_10')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_11', 'foreign_mt_color_patterns_11')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_12', 'foreign_mt_color_patterns_12')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_13', 'foreign_mt_color_patterns_13')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_14', 'foreign_mt_color_patterns_14')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_15', 'foreign_mt_color_patterns_15')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_16', 'foreign_mt_color_patterns_16')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_17', 'foreign_mt_color_patterns_17')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_18', 'foreign_mt_color_patterns_18')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_19', 'foreign_mt_color_patterns_19')->references('id')->on('mt_colors');
            $table->foreign('mt_color_id_20', 'foreign_mt_color_patterns_20')->references('id')->on('mt_colors');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_color_patterns_21')->references('id')->on('mt_users');
            $table->comment('カラーパターンマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_color_patterns');
    }
};
