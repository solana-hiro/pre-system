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
        Schema::create('def_3_menus', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('def_1_menu_id')->unsigned()->nullable(false)->comment('メニュー１定義ＩＤ');
			$table->bigInteger('def_2_menu_id')->unsigned()->nullable(false)->comment('メニュー２定義ＩＤ');
			$table->string('menu_3_name', 20)->nullable(false)->comment('メニュー３名');
			$table->char('disp_id', 6)->nullable(false)->comment('画面ＩＤ');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('def_1_menu_id', 'idx_def_3_menus_01');
            $table->index('def_2_menu_id', 'idx_def_3_menus_02');
            $table->index('disp_id', 'idx_def_3_menus_03');
            $table->index('sort_order', 'idx_def_3_menus_04');
            $table->foreign('def_1_menu_id', 'foreign_def_3_menus_01')->references('id')->on('def_1_menus');
            $table->foreign('def_2_menu_id', 'foreign_def_3_menus_02')->references('id')->on('def_2_menus');
            $table->comment('メニュー３定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_3_menus');
    }
};
