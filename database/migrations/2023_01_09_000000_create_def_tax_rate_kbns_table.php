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
        Schema::create('def_tax_rate_kbns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('tax_rate_kbn_cd', 1)->nullable(false)->comment('税率区分コード');
			$table->string('tax_rate_kbn_name', 20)->nullable(false)->comment('税率区分名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('tax_rate_kbn_cd', 'idx_def_tax_rate_kbns_01');
            $table->comment('税率区分定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_tax_rate_kbns');
    }
};
