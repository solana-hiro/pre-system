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
        Schema::create('mt_item_classes', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('def_item_class_thing_id')->unsigned()->nullable(false)->comment('商品分類項目定義ＩＤ');
			$table->string('item_class_cd', 6)->nullable(false)->comment('商品分類コード');
			$table->string('item_class_name', 20)->nullable(true)->comment('商品分類名');
			$table->tinyInteger('ec_display_flg')->nullable(false)->default(0)->comment('ＥＣ表示フラグ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['def_item_class_thing_id', 'item_class_cd'], 'unique_mt_item_classes_02');
            $table->index('def_item_class_thing_id', 'idx_mt_item_classes_01');
            $table->index('item_class_cd', 'idx_mt_item_classes_02');
            $table->foreign('def_item_class_thing_id', 'foreign_mt_item_classes_01')->references('id')->on('def_item_class_things');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_item_classes_02')->references('id')->on('mt_users');
            $table->comment('商品分類マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_item_classes');
    }
};
