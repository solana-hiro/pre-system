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
        Schema::create('numbering', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('now_ec_order_settlement_station_demand_number', 17)->nullable(false)->comment('最終発行決済ステーション請求番号');
			$table->string('now_ec_order_receive_number', 9)->nullable(false)->comment('最終発行EC注文番号');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('採番情報');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('numbering');
    }
};
