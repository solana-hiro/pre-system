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
        Schema::create('mt_system', function (Blueprint $table) {
			$table->id()->unique()->comment('ID');
			$table->string('corp_name', 30)->nullable(false)->comment('正式会社名');
			$table->string('corp_name_abbreviation', 30)->nullable(false)->comment('会社名略称');
			$table->string('corp_name_kana', 30)->nullable(false)->comment('会社名カナ');
			$table->string('post_number', 8)->nullable(false)->comment('郵便番号');
			$table->string('address_1', 90)->nullable(false)->comment('住所');
			$table->string('tel', 15)->nullable(true)->comment('ＴＥＬ');
			$table->string('fax', 15)->nullable(true)->comment('ＦＡＸ');
			$table->string('representative_name', 30)->nullable(true)->comment('代表者職氏名');
			$table->string('manager_name', 30)->nullable(true)->comment('担当者職氏名');
			$table->string('memo_1', 100)->nullable(true)->comment('備考１');
			$table->string('memo_2', 100)->nullable(true)->comment('備考２');
			$table->string('memo_3', 100)->nullable(true)->comment('備考３');
			$table->string('url', 2083)->nullable(true)->comment('ＵＲＬ');
			$table->string('invoice_no', 14)->nullable(true)->comment('登録番号');
			$table->decimal('1_year_less_than_stock_rate', 4, 1)->nullable(false)->comment('1年未満在庫掛率');
			$table->decimal('1_year_before_stock_rate', 4, 1)->nullable(false)->comment('1年前在庫掛率');
			$table->decimal('2_year_before_stock_rate', 4, 1)->nullable(false)->comment('2年前在庫掛率');
			$table->decimal('3_year_before_stock_rate', 4, 1)->nullable(false)->comment('3年前在庫掛率');
			$table->decimal('4_year_before_stock_rate', 4, 1)->nullable(false)->comment('4年前在庫掛率');
			$table->string('settlement_month_date', 4)->nullable(false)->comment('決算月日');
			$table->tinyInteger('stock_evaluation_method')->nullable(false)->default(0)->comment('在庫評価方法');
			$table->tinyInteger('accounts_receivable_payable_tax_kbn')->default(0)->nullable(false)->comment('売買掛消費税区分');
			$table->tinyInteger('sale_price_adoption_kbn')->nullable(false)->default(0)->comment('売上単価採用区分');
			$table->string('detail_keep_period_month', 2)->nullable(false)->comment('明細保存期間（月）');
			$table->string('summary_keep_period_year', 2)->nullable(false)->comment('サマリ保存期間（年）');
			$table->date('operation_start_date')->nullable(true)->comment('運用開始日');
			$table->date('month_update_execution_date')->nullable(true)->comment('月次更新実行日');
			$table->date('year_update_execution_date')->nullable(true)->comment('年次更新実行日');
			$table->string('industry_cd', 8)->nullable(true)->comment('業種コード');
			$table->string('version', 10)->nullable(true)->comment('バージョン');
			$table->string('maintenance_manager', 30)->nullable(true)->comment('保守担当者');
			$table->string('inquiry_mail', 256)->nullable(true)->comment('問合せメールアドレス');
			$table->string('inquiry_tel', 30)->nullable(true)->comment('問合せ電話番号');
			$table->tinyInteger('shipping_apportionment_method')->nullable(false)->default(0)->comment('按分方式');
			$table->tinyInteger('marketing_possible_quantity_initial_display')->default(0)->nullable(false)->comment('販売可能数初期表示');
			$table->tinyInteger('shipping_quantity_initial_display')->nullable(false)->default(0)->comment('出荷数量初期表示');
			$table->bigInteger('mt_warehouse_id')->unsigned()->nullable(false)->comment('倉庫マスタＩＤ');
			$table->tinyInteger('apportionment_possible_quantity_input_kbn')->nullable(false)->dafault(0)->comment('按分可能数量入力区分');
			$table->tinyInteger('instruction_possible_quantity_input_kbn')->nullable(false)->dafault(0)->comment('指示可能数量入力区分');
			$table->tinyInteger('handy_adoption_kbn')->nullable(false)->dafault(0)->comment('ハンディ採用区分');
			$table->string('start_jan_code', 12)->nullable(false)->comment('開始ＪＡＮ');
			$table->string('end_jan_code', 12)->nullable(false)->comment('終了ＪＡＮ');
			$table->string('now_jan_code', 12)->nullable(false)->comment('現在ＪＡＮ');
			$table->tinyInteger('barcode_issue_order')->nullable(false)->dafault(0)->comment('バーコード発行機能：発注');
			$table->tinyInteger('barcode_issue_purchase')->nullable(false)->dafault(0)->comment('バーコード発行機能：仕入');
			$table->tinyInteger('barcode_issue_in_out')->nullable(false)->dafault(0)->comment('バーコード発行機能：入出庫');
			$table->tinyInteger('ecsite_open_situation')->nullable(false)->default(0)->comment('ECサイトオープン状態');
			$table->string('settlement_method_name', 30)->nullable(false)->comment('決済方法名');
			$table->tinyInteger('display_flg')->nullable(true)->dafault(0)->comment('表示フラグ');
			$table->string('explanatory_text', 1000)->nullable(true)->comment('説明文');
			$table->string('shop_id', 20)->nullable(true)->comment('ショップID');
			$table->string('shop_password', 20)->nullable(true)->comment('ショップパスワード');
			$table->string('3dsecure_display_store_name', 20)->nullable(true)->comment('3Dセキュア表示店舗名');
			$table->string('token_conversion_api_key', 20)->nullable(true)->comment('トークン変換APIキー');
			$table->tinyInteger('security_cd_use_flg')->nullable(true)->dafault(1)->comment('セキュリティコード使用フラグ');
			$table->tinyInteger('card_number_keep_function')->nullable(true)->dafault(0)->comment('カード番号保存機能');
			$table->string('site_id', 20)->nullable(true)->comment('サイトID');
			$table->string('site_password', 20)->nullable(true)->comment('サイトパスワード');
			$table->string('copyright', 100)->nullable(true)->comment('コピーライト');
			$table->string('contact_mail', 256)->nullable(true)->comment('お問い合わせ用メールアドレス');
			$table->tinyInteger('access_point')->nullable(true)->dafault(0)->comment('接続先');
			$table->bigInteger('mt_user_last_update_id')->unsigned()->nullable(true)->dafault(0)->comment('ユーザマスタ最終更新ＩＤ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('mt_warehouse_id', 'idx_mt_system_01');
            $table->foreign('mt_warehouse_id', 'foreign_mt_system_01')->references('id')->on('mt_warehouses');
            $table->foreign('mt_user_last_update_id', 'foreign_mt_system_02')->references('id')->on('mt_users');
            $table->comment('システムマスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropSoftDeletes('mt_system');
    }
};
