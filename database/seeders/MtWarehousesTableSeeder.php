<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtWarehouse;

class MtWarehousesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtWarehouse::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = MtWarehouse::create(['warehouse_cd' => '000001', 'warehouse_name' => '物流センター', 'warehouse_name_kana' => 'ﾌﾞﾂﾘｭｳｾﾝﾀｰ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '100001', 'warehouse_name' => '直販倉庫', 'warehouse_name_kana' => 'ﾁｮｸﾊﾝ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '100005', 'warehouse_name' => 'アマゾンＪＰＳＣ', 'warehouse_name_kana' => 'ｱﾏｿﾞﾝJPSC', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '100010', 'warehouse_name' => 'アマゾンＵＳＡ', 'warehouse_name_kana' => 'ｱﾏｿﾞﾝﾕｰｴｽｴ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '100100', 'warehouse_name' => 'ｼﾝｶﾞﾎﾟｰﾙ倉庫', 'warehouse_name_kana' => 'ｼﾝｶﾞﾎﾟｰﾙ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '110011', 'warehouse_name' => '営業管理倉庫', 'warehouse_name_kana' => 'ｴｲｷﾞｮｳｶﾝﾘ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '110022', 'warehouse_name' => '生産管理倉庫', 'warehouse_name_kana' => 'ｾｲｻﾝｶﾝﾘ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '111111', 'warehouse_name' => 'Ｃ品倉庫', 'warehouse_name_kana' => 'Cﾋﾝ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '111112', 'warehouse_name' => '在庫調整倉庫', 'warehouse_name_kana' => 'ｻﾞｲｺﾁｮｳｾｲ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155511', 'warehouse_name' => '小西マーク倉庫', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155512', 'warehouse_name' => 'タグ替倉庫', 'warehouse_name_kana' => 'ﾀｸﾞｶｴ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155513', 'warehouse_name' => '袋出倉庫', 'warehouse_name_kana' => 'ﾌｸﾛﾀﾞｼ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155514', 'warehouse_name' => 'ひまわり倉庫', 'warehouse_name_kana' => 'ﾋﾏﾜﾘ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155515', 'warehouse_name' => 'マークス熊本倉庫', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155516', 'warehouse_name' => '丸井織物DP(能登)倉庫', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155517', 'warehouse_name' => '倉庫精練DP(金沢)倉庫', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155518', 'warehouse_name' => 'ｗｕｎｄｏｕ加工倉庫', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155519', 'warehouse_name' => 'サムライ倉庫', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155520', 'warehouse_name' => 'メイク倉庫', 'warehouse_name_kana' => 'ﾒｲｸ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155540', 'warehouse_name' => '付属品工場預け倉庫', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155553', 'warehouse_name' => 'ｲｹｼﾞﾏ倉庫', 'warehouse_name_kana' => 'ｲｹｼﾞﾏ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155558', 'warehouse_name' => '未検品倉庫', 'warehouse_name_kana' => 'ﾐｹﾝﾋﾟﾝ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '155559', 'warehouse_name' => '修理品倉庫', 'warehouse_name_kana' => 'ｼｭｳﾘﾋﾝ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '177777', 'warehouse_name' => '発注用倉庫', 'warehouse_name_kana' => 'ﾊｯﾁｭｳﾖｳ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '188888', 'warehouse_name' => '入荷後出荷倉庫', 'warehouse_name_kana' => 'ﾆｭｳｶｺﾞｼｭｯｶ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '199999', 'warehouse_name' => '不良品倉庫', 'warehouse_name_kana' => 'ﾌﾘｮｳﾋﾝ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '888801', 'warehouse_name' => 'ｾﾝﾀｰ付属品倉庫', 'warehouse_name_kana' => 'ｾﾝﾀｰﾌｿﾞｸﾋﾝ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '888803', 'warehouse_name' => 'ｲｹｼﾞﾏ付属品倉庫', 'warehouse_name_kana' => 'ｲｹｼﾞﾏﾌｿﾞｸﾋ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '888805', 'warehouse_name' => 'リセラ付属品倉庫', 'warehouse_name_kana' => 'ﾘｾﾗﾌｿﾞｸﾋﾝ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '980001', 'warehouse_name' => 'ｶﾌﾟｾﾙﾎﾞｯｸｽ受託倉庫', 'warehouse_name_kana' => 'ｶﾌﾟｾﾙﾎﾞｯｸｽ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '980002', 'warehouse_name' => 'トムス受託倉庫', 'warehouse_name_kana' => 'ﾄﾑｽ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '980003', 'warehouse_name' => 'オリラボ受託倉庫', 'warehouse_name_kana' => 'ｵﾘﾗﾎﾞ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '999101', 'warehouse_name' => 'ＷＤ預り倉庫', 'warehouse_name_kana' => 'WDｱｽﾞｶﾘｿｳｺ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 1,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '999102', 'warehouse_name' => '外注預り倉庫', 'warehouse_name_kana' => 'ｶﾞｲﾁｭｳｱｽﾞｶ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 1,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '999991', 'warehouse_name' => '対象外倉庫', 'warehouse_name_kana' => 'ﾀｲｼｮｳｶﾞｲ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '999992', 'warehouse_name' => '末入荷翌月仕入倉庫', 'warehouse_name_kana' => 'ﾏﾂﾆｭｳｶﾖｸｹﾞ', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 1,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
		$model = MtWarehouse::create(['warehouse_cd' => '999999', 'warehouse_name' => '', 'warehouse_name_kana' => '', 'warehouse_kind' => 0,'analysis_warehouse_kbn' => 0,'asset_stock_validity_kbn' => 0,'del_kbn' => 0, 'mt_user_last_update_id' => 1]);
    }

}
