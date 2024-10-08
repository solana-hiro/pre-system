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
        Schema::table('trn_payment_headers', function (Blueprint $table) {
            $table->bigInteger('mt_billing_address_id')->unsigned()->nullable(false)->comment('請求先マスタＩＤ');
            $table->foreign('mt_billing_address_id', 'foreign_trn_payment_headers_05')->references('id')->on('mt_billing_addresses');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trn_payment_headers', function (Blueprint $table) {
            //
        });
    }
};
