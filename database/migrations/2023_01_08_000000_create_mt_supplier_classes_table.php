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
        Schema::create('mt_supplier_classes', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('def_supplier_class_thing_id')->unsigned()->nullable(false)->comment('仕入先分類項目定義ＩＤ');
			$table->string('supplier_class_cd', 4)->nullable(false)->unique()->comment('仕入先分類コード');
			$table->string('supplier_class_name', 20)->nullable(true)->comment('仕入先分類名');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('def_supplier_class_thing_id', 'idx_mt_supplier_classes_01');
            $table->index('supplier_class_cd', 'idx_mt_supplier_classes_02');
            $table->foreign('def_supplier_class_thing_id', 'foreign_mt_supplier_classes_01')->references('id')->on('def_supplier_class_things');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_supplier_classes_02')->references('id')->on('mt_users');
            $table->comment('仕入先分類マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_supplier_classes');
    }
};
