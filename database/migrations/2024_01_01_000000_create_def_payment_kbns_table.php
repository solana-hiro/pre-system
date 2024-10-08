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
        Schema::create('def_payment_kbns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('payment_kbn_cd', 2)->nullable(false)->comment('入金区分コード');
			$table->string('payment_kbn_name', 10)->nullable(false)->comment('入金区分名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('payment_kbn_cd', 'idx_def_payment_kbns_01');
            $table->index('sort_order', 'idx_def_payment_kbns_02');
            $table->comment('入金区分定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_payment_kbns');
    }
};
