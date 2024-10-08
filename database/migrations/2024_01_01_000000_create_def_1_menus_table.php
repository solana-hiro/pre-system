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
        Schema::create('def_1_menus', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('menu_1_name', 20)->nullable(false)->comment('メニュー１名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('sort_order', 'idx_def_1_menus_01');
            $table->comment('メニュー１定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_1_menus');
    }
};
