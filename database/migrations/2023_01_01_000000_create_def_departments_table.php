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
        Schema::create('def_departments', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('department_cd', 4)->nullable(false)->unique()->comment('部門コード');
			$table->string('department_name', 20)->nullable(false)->comment('部門名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_cd', 'idx_def_departments_01');
            $table->index('sort_order', 'idx_def_departments_02');
            $table->comment('部門定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_departments');
    }
};
