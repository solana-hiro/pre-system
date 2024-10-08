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
        Schema::create('def_ps_kbns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('ps_kbn_cd', 1)->nullable(false)->comment('PS区分コード');
			$table->string('ps_kbn_name', 10)->nullable(false)->comment('PS区分名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('ps_kbn_cd', 'idx_def_ps_kbns_01');
            $table->comment('PS区分定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_ps_kbns');
    }
};
