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
        Schema::create('book_edge_classes', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('book_edge_cd', 4)->nullable(false)->comment('帳端区分コード')->unique();
            $table->string('book_edge_name', 30)->nullable(false)->comment('帳端区分名');
            $table->integer('sort_order')->nullable(false)->comment('並び順')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->index('book_edge_cd', 'idx_book_edge_classes_01');
            $table->index('sort_order', 'idx_book_edge_classes_02');
            $table->comment('帳端区分定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('book_edge_classes');
    }
};
