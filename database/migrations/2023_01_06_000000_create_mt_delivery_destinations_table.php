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
        Schema::create('mt_delivery_destinations', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('delivery_destination_id', 6)->nullable(false)->unique()->comment('納品先コード');
			$table->string('delivery_destination_name', 60)->nullable(false)->comment('納品先名');
			$table->string('delivery_destination_name_kana', 10)->nullable(true)->comment('納品先名カナ');
			$table->tinyInteger('honorific_kbn')->nullable(false)->default(1)->comment('敬称区分');
			$table->string('post_number', 8)->nullable(true)->comment('郵便番号');
			$table->string('address', 90)->nullable(true)->comment('住所');
			$table->string('tel', 15)->nullable(true)->comment('ＴＥＬ');
			$table->string('fax', 15)->nullable(true)->comment('ＦＡＸ');
			$table->string('representative_name', 30)->nullable(true)->comment('代表者名');
			$table->string('representative_mail', 256)->nullable(true)->comment('代表者メール');
			$table->string('delivery_destination_manager_name', 30)->nullable(true)->comment('納品先担当者名');
			$table->string('delivery_destination_manager_mail', 256)->nullable(true)->comment('納品先担当者メール');
			$table->string('delivery_destination_url', 2083)->nullable(true)->comment('納品先ＵＲＬ');
			$table->integer('delivery_price')->nullable(false)->comment('館内配送料');
			$table->tinyInteger('name_input_kbn')->nullable(true)->comment('名称入力区分');
			$table->tinyInteger('del_kbn_delivery_destination')->nullable(true)->comment('削除区分(納品先)');
			$table->bigInteger('mt_user_register_id')->unsigned()->nullable(true)->comment('ユーザマスタ登録者ＩＤ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(true)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('delivery_destination_id', 'idx_mt_delivery_destinations_01');
            $table->foreign('mt_user_register_id', 'foreign_mt_delivery_destinations_01')->references('id')->on('mt_users');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_delivery_destinations_02')->references('id')->on('mt_users');
            $table->comment('納品先マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_delivery_destinations');
    }
};
