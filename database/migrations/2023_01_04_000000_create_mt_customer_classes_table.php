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
        Schema::create('mt_customer_classes', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->bigInteger('def_customer_class_thing_id')->unsigned()->nullable(false)->comment('得意先分類項目定義ＩＤ');
			$table->string('customer_class_cd', 4)->nullable(false)->comment('得意先分類コード');
			$table->string('customer_class_name', 20)->nullable(true)->comment('得意先分類名');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['def_customer_class_thing_id', 'customer_class_cd'], 'unique_mt_customer_classes_02');
            $table->index('def_customer_class_thing_id', 'idx_mt_customer_classes_01');
            $table->index('customer_class_cd', 'idx_mt_customer_classes_02');
            $table->foreign('def_customer_class_thing_id', 'foreign_mt_customer_classes_01')->references('id')->on('def_customer_class_things');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_customer_classes_02')->references('id')->on('mt_users');
            $table->comment('得意先分類マスタ');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_customer_classes');
    }
};
