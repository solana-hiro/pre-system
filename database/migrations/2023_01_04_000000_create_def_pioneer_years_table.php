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
        Schema::create('def_pioneer_years', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('pioneer_year_cd', 4)->nullable(false)->unique()->comment('開拓年分類コード');
			$table->string('pioneer_year_name', 30)->nullable(false)->comment('開拓年分類名');
			$table->Integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('pioneer_year_cd', 'idx_def_pioneer_years_01');
            $table->index('sort_order', 'idx_def_pioneer_years_02');
            $table->comment('開拓年分類定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_pioneer_years');
    }
};
