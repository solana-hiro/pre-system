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
        Schema::create('mt_order_receive_sticky_notes', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->bigInteger('def_sticky_note_kind_id')->unsigned()->nullable(false)->comment('付箋種別定義ＩＤ');
			$table->integer('branch_number')->nullable(false)->comment('枝番');
			$table->string('sticky_note_color', 7)->nullable(false)->comment('付箋色');
			$table->string('sticky_note_name', 20)->nullable(true)->comment('付箋名');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('def_sticky_note_kind_id', 'idx_mt_order_receive_sticky_notes_01');
            $table->foreign('def_sticky_note_kind_id', 'foreign_mt_order_receive_sticky_notes_01')->references('id')->on('def_sticky_note_kinds');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_order_receive_sticky_notes_02')->references('id')->on('mt_users');
            $table->comment('受注付箋マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_order_receive_sticky_notes');
    }
};
