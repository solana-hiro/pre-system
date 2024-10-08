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
        Schema::create('def_item_change_history_things', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('thing_cd', 4)->nullable(false)->unique()->comment('項目コード');
			$table->string('thing_name', 20)->nullable(false)->comment('項目名');
            $table->timestamps();
            $table->softDeletes();

            $table->index('thing_cd', 'idx_def_item_change_history_things_01');
            $table->comment('商品変更履歴項目定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_item_change_history_things');
    }
};
