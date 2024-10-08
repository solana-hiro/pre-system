<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefItemChangeHistoryThing;

class DefItemChangeHistoryThingsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefItemChangeHistoryThing::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0001', 'thing_name' => '新規作成']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0002', 'thing_name' => '削除']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0003', 'thing_name' => '商品コード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0004', 'thing_name' => '仕入先コード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0005', 'thing_name' => '商品名']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0006', 'thing_name' => '他品番']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0007', 'thing_name' => '商品名カナ']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0008', 'thing_name' => '単位']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0009', 'thing_name' => '工場分類5コード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0010', 'thing_name' => '製品/工賃6コード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0011', 'thing_name' => '資産在庫JAコード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0012', 'thing_name' => '商品区分']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0013', 'thing_name' => '在庫管理区分']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0014', 'thing_name' => '非課税区分']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0015', 'thing_name' => '税率区分']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0016', 'thing_name' => '税抜上代単価']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0017', 'thing_name' => '税込上代単価']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0018', 'thing_name' => '税抜参考上代']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0019', 'thing_name' => '税込参考上代']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0020', 'thing_name' => '税抜仕入単価']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0021', 'thing_name' => '税込仕入単価']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0022', 'thing_name' => '原価単価']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0023', 'thing_name' => '粗利算出用原価単価']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0024', 'thing_name' => '名称入力区分']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0025', 'thing_name' => '削除区分']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0026', 'thing_name' => 'メンバーサイト連携区分']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0027', 'thing_name' => '日本郵政']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0028', 'thing_name' => 'カラーコード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0029', 'thing_name' => 'サイズコード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0030', 'thing_name' => 'メンバーサイト商品コード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0031', 'thing_name' => 'メンバーサイト商品名']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0032', 'thing_name' => 'ランキング']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0033', 'thing_name' => 'プリント商品']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0034', 'thing_name' => 'ブランド1コード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0035', 'thing_name' => '競技・カテゴリコード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0036', 'thing_name' => 'ジャンルコード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0037', 'thing_name' => '販売開始年コード']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0038', 'thing_name' => '商品画像ファイル1']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0039', 'thing_name' => '商品画像ファイル2']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0040', 'thing_name' => '商品画像ファイル3']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0041', 'thing_name' => '商品画像ファイル4']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0042', 'thing_name' => 'PDFファイル1']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0043', 'thing_name' => 'PDFファイル2']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0044', 'thing_name' => 'PDFファイル3']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0045', 'thing_name' => 'PDFファイル4']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0046', 'thing_name' => 'PDFファイル5']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0047', 'thing_name' => '商品バナー画像ファイル1']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0048', 'thing_name' => '商品バナー画像ファイル2']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0049', 'thing_name' => '商品備考１']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0050', 'thing_name' => '商品備考２']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0051', 'thing_name' => '商品備考３']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0052', 'thing_name' => '商品備考４']);
		$model = DefItemChangeHistoryThing::create(['thing_cd' => '0053', 'thing_name' => '商品備考５']);

    }

}
