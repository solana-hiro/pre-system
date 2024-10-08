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
        Schema::create('def_customer_class_things', function (Blueprint $table) {
            $table->id()->unique()->comment('ID');
			$table->string('customer_class_thing_name', 20)->nullable(false)->comment('得意先分類項目名');
			$table->Integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('sort_order', 'idx_def_customer_class_things_01');
            $table->comment('得意先分類項目定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_customer_class_things');
    }
};
