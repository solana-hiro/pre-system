<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtItemClass;

class MtItemClassesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtItemClass::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0001', 'item_class_name' => 'Ｐシリーズ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0003', 'item_class_name' => 'ＯＥＭ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0004', 'item_class_name' => '学販', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0011', 'item_class_name' => 'Ｋシリーズ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0061', 'item_class_name' => 'MPシリーズ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0070', 'item_class_name' => 'プリント', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0080', 'item_class_name' => '刺繍', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0088', 'item_class_name' => '値引', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0091', 'item_class_name' => '生地', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0092', 'item_class_name' => '付属品', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0093', 'item_class_name' => '運賃（未使用）', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0094', 'item_class_name' => '直販運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0095', 'item_class_name' => 'その他運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0096', 'item_class_name' => '福山通運', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0097', 'item_class_name' => 'ヤマト運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0098', 'item_class_name' => '佐川運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0099', 'item_class_name' => 'その他', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '0999', 'item_class_name' => 'カタログ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '801111', 'item_class_name' => '福山通常便', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '802222', 'item_class_name' => 'ﾔﾏﾄ通常便', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '807777', 'item_class_name' => '郵政通常便', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '809999', 'item_class_name' => 'その他通常便', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '812222', 'item_class_name' => 'ﾔﾏﾄ別便', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '8888', 'item_class_name' => 'テストテスト', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '9991', 'item_class_name' => '消費税', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 1, 'item_class_cd' => '9999', 'item_class_name' => '廃番', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0001', 'item_class_name' => '定番アイテム', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0002', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0010', 'item_class_name' => 'サッカー', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0012', 'item_class_name' => '野球', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0014', 'item_class_name' => 'バレーボール', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0016', 'item_class_name' => 'ラグビー', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0018', 'item_class_name' => 'バスケットボール', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0020', 'item_class_name' => '陸上', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0022', 'item_class_name' => '体操', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0024', 'item_class_name' => 'テニス', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0026', 'item_class_name' => 'バドミントン', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0030', 'item_class_name' => '水泳', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0032', 'item_class_name' => 'ﾚｽﾘﾝｸﾞ/ｳｴｲﾄﾘﾌﾃｨﾝｸﾞ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0034', 'item_class_name' => 'ボクシング', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0036', 'item_class_name' => 'フィットネス', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0038', 'item_class_name' => 'アウトドア', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0040', 'item_class_name' => 'サポーター', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0050', 'item_class_name' => 'インナー', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0070', 'item_class_name' => 'プリント', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0080', 'item_class_name' => '刺繍', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0088', 'item_class_name' => '値引', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0091', 'item_class_name' => '生地', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0092', 'item_class_name' => '付属品', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0094', 'item_class_name' => '直販運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0095', 'item_class_name' => 'その他運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0096', 'item_class_name' => '福山通運', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0097', 'item_class_name' => 'ヤマト運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0098', 'item_class_name' => '佐川運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0099', 'item_class_name' => 'その他', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '0999', 'item_class_name' => 'カタログ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 2, 'item_class_cd' => '9991', 'item_class_name' => '消費税', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0001', 'item_class_name' => '半袖シャツ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0002', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0003', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0010', 'item_class_name' => 'ポロシャツ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0020', 'item_class_name' => 'ノースリーブシャツ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0025', 'item_class_name' => '長袖シャツ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0030', 'item_class_name' => 'ｲﾝﾅｰ・ｽﾎﾟｰﾂﾌﾞﾗ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0035', 'item_class_name' => 'パンツ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0040', 'item_class_name' => 'ジャージ上下', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0045', 'item_class_name' => 'ｽｳｪｯﾄ・ﾄﾚｰﾅｰ上下', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0050', 'item_class_name' => 'ｳｨﾝﾄﾞﾌﾞﾚｰｶｰ上下', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0055', 'item_class_name' => 'ピステ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0060', 'item_class_name' => 'ｼﾞｬｹｯﾄ・ｼﾞｬﾝﾊﾟｰ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0065', 'item_class_name' => 'コート', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0070', 'item_class_name' => '専門競技着/水着', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0075', 'item_class_name' => '帽子・ｿｯｸｽ・ｱｸｾｻﾘｰ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0078', 'item_class_name' => 'カバン', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0080', 'item_class_name' => 'シューズ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0086', 'item_class_name' => 'ＯＥＭ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0087', 'item_class_name' => 'その他', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0088', 'item_class_name' => '値引き', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0091', 'item_class_name' => '生地', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0099', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0100', 'item_class_name' => '廃番', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '0999', 'item_class_name' => '商品以外', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 3, 'item_class_cd' => '9991', 'item_class_name' => '消費税', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0001', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0002', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0003', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0004', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0005', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0006', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0007', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0008', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0009', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0010', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0011', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0012', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0088', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '0099', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2005', 'item_class_name' => '2005年以前', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2011', 'item_class_name' => '2006～2011年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2012', 'item_class_name' => '2012年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2013', 'item_class_name' => '2013年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2014', 'item_class_name' => '2014年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2015', 'item_class_name' => '2015年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2016', 'item_class_name' => '2016年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2017', 'item_class_name' => '2017年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2018', 'item_class_name' => '2018年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2019', 'item_class_name' => '2019年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2020', 'item_class_name' => '2020年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '2021', 'item_class_name' => '2021年', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '8888', 'item_class_name' => '値引き', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '9991', 'item_class_name' => '消費税', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 4, 'item_class_cd' => '9999', 'item_class_name' => 'その他', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '1011', 'item_class_name' => '宇野', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '1012', 'item_class_name' => '安田工業所', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '1030', 'item_class_name' => 'ｲｹｼﾞﾏ', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '1048', 'item_class_name' => '西井幸夫', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '1230', 'item_class_name' => '宝来社', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '1310', 'item_class_name' => '尾崎スクリーン', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2001', 'item_class_name' => '皮口工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2011', 'item_class_name' => '三洲工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2019', 'item_class_name' => '上虞一諾工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2021', 'item_class_name' => '南昌工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2031', 'item_class_name' => '丹東工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2032', 'item_class_name' => '瓦房工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2106', 'item_class_name' => '浙江ﾋﾞﾄｰ工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2108', 'item_class_name' => '寧波海潤工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2110', 'item_class_name' => '海寧富立工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2111', 'item_class_name' => '張家華夏工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2112', 'item_class_name' => '義烏海蒙工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2114', 'item_class_name' => '旭宇', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2115', 'item_class_name' => '嘉興雲翔工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2116', 'item_class_name' => '森欺伯特', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2119', 'item_class_name' => '東連貿易', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2120', 'item_class_name' => '悠楽', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2121', 'item_class_name' => '泉州森泰', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2124', 'item_class_name' => '赤峰', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2871', 'item_class_name' => '南泰工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2872', 'item_class_name' => '千歳藍工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2873', 'item_class_name' => '禾悦工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2874', 'item_class_name' => '蓋州格林', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2961', 'item_class_name' => '四平工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2962', 'item_class_name' => '北京承徳工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2991', 'item_class_name' => '雪燕工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2992', 'item_class_name' => '衆邦工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2993', 'item_class_name' => '諸城工場', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '2994', 'item_class_name' => '高木', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '9991', 'item_class_name' => '消費税', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 5, 'item_class_cd' => '9999', 'item_class_name' => 'その他', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0000', 'item_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0001', 'item_class_name' => '製品', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0002', 'item_class_name' => '工賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0003', 'item_class_name' => '生地等', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0004', 'item_class_name' => 'プリント等', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0005', 'item_class_name' => '運賃', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0006', 'item_class_name' => 'ケース', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '0099', 'item_class_name' => 'その他', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 6, 'item_class_cd' => '9991', 'item_class_name' => '消費税', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 7, 'item_class_cd' => '0000', 'item_class_name' => '無効', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 7, 'item_class_cd' => '0001', 'item_class_name' => '有効', 'mt_user_last_update_id' => 1]);
		$model = MtItemClass::create(['def_item_class_thing_id' => 7, 'item_class_cd' => '9991', 'item_class_name' => '消費税', 'mt_user_last_update_id' => 1]);
    }

}
