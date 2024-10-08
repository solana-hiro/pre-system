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
            $table->string('item_banner_url_1', 2083)->nullable(true)->after('item_banner_image_file_2')->comment('商品バナーURL1');
            $table->string('item_banner_url_2', 2083)->nullable(true)->after('item_banner_url_1')->comment('商品バナーURL2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_member_site_items', function (Blueprint $table) {
            $table->dropColumn('item_banner_url_1');
            $table->dropColumn('item_banner_url_2');
        });
    }
};
