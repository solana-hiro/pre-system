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
        Schema::create('def_slip_kind_kbns', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('slip_kind_kbn_cd', 2)->nullable(false)->comment('伝票種別区分コード');
			$table->string('slip_kind_kbn_name', 20)->nullable(false)->comment('伝票種別区分名');
			$table->integer('sort_order')->nullable(false)->comment('並び順');
            $table->timestamps();
            $table->softDeletes();

            $table->index('slip_kind_kbn_cd', 'idx_def_slip_kind_kbns_01');
            $table->comment('伝票種別区分定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('def_slip_kind_kbns');
    }
};
