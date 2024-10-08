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
        Schema::create('def_district_classes', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('district_class_cd', 4)->nullable(false)->unique()->comment('地区分類コード');
			$table->string('district_class_name', 30)->nullable(false)->comment('地区分類名');
			$table->Integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('district_class_cd', 'idx_def_district_classes_01');
            $table->index('sort_order', 'idx_def_district_classes_02');
            $table->comment('地区分類定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_district_classes');
    }
};
