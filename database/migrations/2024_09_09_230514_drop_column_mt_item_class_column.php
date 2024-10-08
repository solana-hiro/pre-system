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
        Schema::table('mt_member_site_items', function (Blueprint $table) {
            $table->dropForeign('foreign_mt_member_site_items_01');
            $table->dropForeign('foreign_mt_member_site_items_02');
            $table->dropForeign('foreign_mt_member_site_items_03');
            $table->dropForeign('foreign_mt_member_site_items_04');
            $table->dropColumn('mt_item_class1_id');
            $table->dropColumn('mt_item_class2_id');
            $table->dropColumn('mt_item_class3_id');
            $table->dropColumn('mt_item_class4_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_member_site_items', function (Blueprint $table) {
            //
        });
    }
};
