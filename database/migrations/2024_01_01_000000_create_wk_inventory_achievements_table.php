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
        Schema::create('wk_inventory_achievements', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('wk_inventory_baseid')->unsigned()->nullable(false)->comment('棚卸ベースワークＩＤ');
			$table->integer('inventory_quantity')->nullable(true)->comment('棚卸数量');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('wk_inventory_baseid', 'idx_wk_inventory_achievements_01');
            $table->foreign('wk_inventory_baseid', 'foreign_wk_inventory_achievements_01')->references('id')->on('wk_inventory_bases');
            $table->foreign('mt_user_last_update_id', 'foreign_wk_inventory_achievements_02')->references('id')->on('mt_users');
            $table->comment('棚卸実績ワーク');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('wk_inventory_achievements');
    }
};
