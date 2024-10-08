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
        Schema::create('def_2_menus', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('def_1_menu_id')->unsigned()->nullable(false)->comment('メニュー１定義ＩＤ');
			$table->string('menu_2_name', 20)->nullable(false)->comment('メニュー２名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('def_1_menu_id', 'idx_def_2_menus_01');
            $table->index('sort_order', 'idx_def_2_menus_02');
            $table->foreign('def_1_menu_id', 'foreign_def_2_menus_01')->references('id')->on('def_1_menus');
            $table->comment('メニュー２定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_2_menus');
    }
};
