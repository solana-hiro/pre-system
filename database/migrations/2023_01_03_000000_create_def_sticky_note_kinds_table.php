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
        Schema::create('def_sticky_note_kinds', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('sticky_note_kind_cd', 1)->nullable(false)->comment('付箋種別コード');
			$table->string('sticky_note_kind_name', 20)->nullable(false)->comment('付箋種別名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('sticky_note_kind_cd', 'idx_def_sticky_note_kinds_01');
            $table->comment('付箋種別定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_sticky_note_kinds');
    }
};
