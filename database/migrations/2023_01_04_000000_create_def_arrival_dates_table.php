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
        Schema::create('def_arrival_dates', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('arrival_date_cd', 4)->nullable(false)->unique()->comment('着日コード');
			$table->string('arrival_date_name', 30)->nullable(false)->comment('着日名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('arrival_date_cd', 'idx_def_arrival_dates_01');
            $table->index('sort_order', 'idx_def_arrival_dates_02');
            $table->comment('着日定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_arrival_dates');
    }
};
