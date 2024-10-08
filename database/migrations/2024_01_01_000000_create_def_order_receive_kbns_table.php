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
        Schema::create('def_order_receive_kbns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('order_receive_kbn_cd', 2)->nullable(false)->comment('受注区分コード');
			$table->string('order_receive_kbn_name', 10)->nullable(false)->comment('受注区分名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_receive_kbn_cd', 'idx_def_order_receive_kbns_01');
            $table->comment('受注区分定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_order_receive_kbns');
    }
};
