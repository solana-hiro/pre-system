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
        Schema::create('mt_slip_kinds', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('def_slip_kind_kbn_id')->unsigned()->nullable(false)->comment('伝票種別区分定義ＩＤ');
			$table->string('slip_kind_cd', 3)->nullable(false)->comment('伝票種別コード');
			$table->string('slip_kind_name', 20)->nullable(true)->comment('伝票種別名');
			$table->integer('slip_row')->nullable(false)->comment('伝票行数');
			$table->decimal('paper_width', 7, 3)->nullable(false)->comment('用紙幅');
			$table->decimal('paper_height', 7, 3)->nullable(false)->comment('用紙高さ');
			$table->tinyInteger('output_kbn')->nullable(true)->comment('出力区分');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('def_slip_kind_kbn_id', 'idx_mt_slip_kinds_01');
            $table->foreign('def_slip_kind_kbn_id', 'foreign_mt_slip_kinds_01')->references('id')->on('def_slip_kind_kbns');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_slip_kinds_02')->references('id')->on('mt_users');
            $table->comment('伝票種別マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_slip_kinds');
    }
};
