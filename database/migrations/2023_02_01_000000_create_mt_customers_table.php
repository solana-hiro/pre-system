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
        Schema::create('mt_customers', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('customer_cd', 6)->nullable(false)->unique()->comment('得意先コード');
			$table->bigInteger('mt_billing_address_id')->unsigned()->unsigned()->nullable(false)->comment('請求先マスタＩＤ');
			$table->bigInteger('mt_order_receive_sticky_note_id')->unsigned()->nullable(true)->comment('受注付箋マスタＩＤ');
			$table->string('customer_name', 10)->nullable(true)->comment('得意先名');
			$table->string('customer_name_kana', 10)->nullable(false)->comment('得意先名カナ');
			$table->tinyInteger('honorific_kbn')->nullable(false)->default(1)->comment('敬称区分');
			$table->string('post_number', 8)->nullable(true)->comment('郵便番号');
			$table->string('address', 90)->nullable(true)->comment('住所');
			$table->string('tel', 15)->nullable(true)->comment('ＴＥＬ');
			$table->string('fax', 15)->nullable(true)->comment('ＦＡＸ');
			$table->tinyInteger('direct_delivery_slip_mailing_flg')->nullable(false)->default(1)->comment('直送納品書郵送要不要フラグ');
			$table->bigInteger('def_district_class_id')->unsigned()->nullable(true)->comment('地区分類定義ＩＤ');
			$table->bigInteger('def_pioneer_year_id')->unsigned()->nullable(true)->comment('開拓年分類定義ＩＤ');
			$table->bigInteger('mt_customer_class1_id')->unsigned()->nullable(false)->comment('得意先分類１マスタＩＤ');
			$table->bigInteger('mt_customer_class2_id')->unsigned()->nullable(true)->comment('得意先分類２マスタＩＤ');
			$table->bigInteger('mt_customer_class3_id')->unsigned()->nullable(true)->comment('得意先分類３マスタＩＤ');
			$table->string('representative_name', 30)->nullable(true)->comment('代表者名');
			$table->string('representative_mail', 256)->nullable(true)->comment('代表者メール');
			$table->string('invoice_notification_mail_1', 256)->nullable(true)->comment('請求書通知用メールアドレス１');
			$table->string('invoice_notification_mail_2', 256)->nullable(true)->comment('請求書通知用メールアドレス２');
			$table->string('payment_guidance_mail', 256)->nullable(true)->comment('入金案内用メールアドレス');
			$table->tinyInteger('payment_guidance_send_flg')->nullable(false)->default(2)->comment('入金案内送信要不要フラグ');
			$table->string('customer_url', 2083)->nullable(true)->comment('得意先ＵＲＬ');
			$table->integer('delivery_price')->nullable(true)->comment('館内配送料');
			$table->tinyInteger('price_rate')->nullable(false)->comment('単価掛率');
			$table->bigInteger('mt_user_id')->unsigned()->nullable(false)->comment('ユーザマスタＩＤ');
			$table->tinyInteger('credit_limit_amount_check_flg')->nullable(false)->default(0)->comment('与信限度額チェックフラグ');
			$table->tinyInteger('name_input_kbn')->nullable(false)->default(0)->comment('名称入力区分');
			$table->tinyInteger('del_kbn')->nullable(false)->default(0)->comment('削除区分');
			$table->tinyInteger('tax_fare_rate_application')->nullable(false)->default(0)->comment('消費税：運賃掛率適用');
			$table->bigInteger('mt_warehouse_order_receive_id')->unsigned()->nullable(false)->comment('倉庫マスタ受注ＩＤ');
			$table->tinyInteger('payment_kbn')->nullable(false)->default(1)->comment('入金区分');
			$table->bigInteger('mt_root_id')->unsigned()->nullable(false)->comment('ルートマスタＩＤ');
			$table->bigInteger('mt_item_class_shipping_companie_id')->unsigned()->nullable(false)->comment('運送会社マスタＩＤ');
			$table->bigInteger('mt_slip_kind_sale_id')->unsigned()->nullable(false)->comment('伝票種別マスタ売上伝票ＩＤ');
			$table->bigInteger('def_arrival_date_id')->unsigned()->nullable(false)->comment('着日定義ＩＤ');
			$table->string('customer_memo_1', 30)->nullable(true)->comment('得意先備考１');
			$table->string('customer_memo_2', 30)->nullable(true)->comment('得意先備考２');
			$table->string('customer_memo_3', 30)->nullable(true)->comment('得意先備考３');
			$table->string('customer_expansion_1', 20)->nullable(false)->comment('得意先拡張１');
			$table->string('customer_expansion_2', 20)->nullable(false)->comment('得意先拡張２');
			$table->string('customer_expansion_3', 20)->nullable(false)->comment('得意先拡張３');
			$table->string('customer_expansion_4', 20)->nullable(false)->comment('得意先拡張４');
			$table->string('customer_expansion_5', 20)->nullable(false)->comment('得意先拡張５');
			$table->date('data_decision_date')->nullable(false)->comment('データ確定日');
			$table->bigInteger('mt_user_register_id')->unsigned()->nullable(false)->comment('ユーザマスタ登録者ＩＤ');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(false)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('customer_cd', 'idx_mt_customers_01');
            $table->index('mt_billing_address_id', 'idx_mt_customers_02');
            $table->index('mt_order_receive_sticky_note_id', 'idx_mt_customers_03');
            $table->index('mt_customer_class1_id', 'idx_mt_customers_04');
            $table->index('mt_customer_class2_id', 'idx_mt_customers_05');
            $table->index('mt_customer_class3_id', 'idx_mt_customers_06');
            $table->index('mt_user_id', 'idx_mt_customers_07');
            $table->index('mt_warehouse_order_receive_id', 'idx_mt_customers_08');
            $table->index('mt_root_id', 'idx_mt_customers_09');
            $table->index('mt_item_class_shipping_companie_id', 'idx_mt_customers_10');
            $table->index('mt_slip_kind_sale_id', 'idx_mt_customers_11');

            $table->foreign('mt_billing_address_id', 'foreign_mt_customers_01')->references('id')->on('mt_billing_addresses');
            $table->foreign('mt_order_receive_sticky_note_id', 'foreign_mt_customers_02')->references('id')->on('mt_order_receive_sticky_notes');
            $table->foreign('def_district_class_id', 'foreign_mt_customers_03')->references('id')->on('def_district_classes');
            $table->foreign('def_pioneer_year_id', 'foreign_mt_customers_04')->references('id')->on('def_pioneer_years');
            $table->foreign('mt_customer_class1_id', 'foreign_mt_customers_05')->references('id')->on('mt_customer_classes');
            $table->foreign('mt_customer_class2_id', 'foreign_mt_customers_06')->references('id')->on('mt_customer_classes');
            $table->foreign('mt_customer_class3_id', 'foreign_mt_customers_07')->references('id')->on('mt_customer_classes');
            $table->foreign('mt_user_id', 'foreign_mt_customers_08')->references('id')->on('mt_users');
            $table->foreign('mt_warehouse_order_receive_id', 'foreign_mt_customers_09')->references('id')->on('mt_warehouses');
            $table->foreign('mt_root_id', 'foreign_mt_customers_10')->references('id')->on('mt_roots');
            $table->foreign('mt_item_class_shipping_companie_id', 'foreign_mt_customers_11')->references('id')->on('mt_item_classes');
            $table->foreign('mt_slip_kind_sale_id', 'foreign_mt_customers_12')->references('id')->on('mt_slip_kinds');
            $table->foreign('def_arrival_date_id', 'foreign_mt_customers_13')->references('id')->on('def_arrival_dates');
            $table->foreign('mt_user_register_id', 'foreign_mt_customers_14')->references('id')->on('mt_users');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_customers_15')->references('id')->on('mt_users');
            $table->comment('メニュー３定義');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_customers');
    }
};
