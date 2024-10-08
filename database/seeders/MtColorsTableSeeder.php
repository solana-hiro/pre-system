<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtColor;

class MtColorsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtColor::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = MtColor::create(['color_cd' => '0000', 'color_name' => 'ﾎﾜｲﾄ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0001', 'color_name' => 'ﾈｲﾋﾞｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0002', 'color_name' => 'ﾀｰｺｲｽﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0003', 'color_name' => 'ﾌﾞﾙｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0004', 'color_name' => 'ｻｯｸｽ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0005', 'color_name' => 'ﾛｲﾔﾙ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0006', 'color_name' => 'Dﾈｲﾋﾞｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0007', 'color_name' => 'ｼｬｰﾍﾞｯﾄB', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0008', 'color_name' => 'SDﾌﾞﾙｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0010', 'color_name' => 'ﾊﾞｰﾐﾘｵﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0011', 'color_name' => 'ﾚｯﾄﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0012', 'color_name' => 'ﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0013', 'color_name' => 'Lﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0014', 'color_name' => 'ﾊﾞｰｶﾞﾝﾃﾞｨ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0015', 'color_name' => 'ｵﾚﾝｼﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0016', 'color_name' => 'Dｵﾚﾝｼﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0017', 'color_name' => 'Bﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0018', 'color_name' => 'ﾎｯﾄﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0019', 'color_name' => 'ﾋﾟﾝｸC', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0020', 'color_name' => 'Bｵﾚﾝｼﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0021', 'color_name' => 'ｲｴﾛｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0022', 'color_name' => 'GOｲｴﾛｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0023', 'color_name' => 'ｸﾘｰﾑY', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0024', 'color_name' => 'Eｸﾞﾘｰﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0025', 'color_name' => 'Lｸﾞﾘｰﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0026', 'color_name' => 'ｸﾞﾘｰﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0027', 'color_name' => 'Bｸﾞﾘｰﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0028', 'color_name' => 'ｵﾘｰﾌﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0029', 'color_name' => 'ﾌﾞﾛﾝｽﾞG', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0030', 'color_name' => 'Dｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0031', 'color_name' => 'Lｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0032', 'color_name' => 'ﾓｸｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0033', 'color_name' => 'Aｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0034', 'color_name' => 'ﾌﾞﾗｯｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0036', 'color_name' => 'Sﾎﾜｲﾄ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0040', 'color_name' => 'ﾌﾟﾗﾑ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0041', 'color_name' => 'ﾊﾟｰﾌﾟﾙ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0042', 'color_name' => 'ﾗﾍﾞﾝﾀﾞｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0043', 'color_name' => 'ﾛｰｽﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0045', 'color_name' => 'ﾁｬｺｰﾙｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0046', 'color_name' => 'Dﾁｬｺｰﾙｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0047', 'color_name' => 'ﾌﾞﾙｰｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0050', 'color_name' => 'ｱｲﾎﾞﾘｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0051', 'color_name' => 'Sﾍﾞｰｼﾞｭ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0052', 'color_name' => 'ﾌﾞﾗｳﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0053', 'color_name' => 'ｻﾌｧﾘ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0054', 'color_name' => 'ｺﾞｰﾙﾄﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0055', 'color_name' => 'Gｵﾚﾝｼﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0056', 'color_name' => 'ﾍﾞｰｼﾞｭ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0058', 'color_name' => 'ｷｬﾒﾙ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0060', 'color_name' => 'WxDｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0061', 'color_name' => 'Wxﾈｲﾋﾞｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0062', 'color_name' => 'Wxｲｴﾛｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0063', 'color_name' => 'Wxﾌﾞﾙｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0064', 'color_name' => 'Wxﾌﾞﾗｯｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0065', 'color_name' => 'Wxﾚｯﾄﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0066', 'color_name' => 'ﾌﾞﾗｯｸxW', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0067', 'color_name' => 'WxLﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0068', 'color_name' => 'LﾋﾟﾝｸxW', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0069', 'color_name' => '黒xﾚｯﾄﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0070', 'color_name' => '蛍光ﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0072', 'color_name' => '蛍光ｵﾚﾝｼﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0073', 'color_name' => '蛍光ﾚﾓﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0074', 'color_name' => '蛍光ｲｴﾛｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0076', 'color_name' => '蛍光ｸﾞﾘｰﾝ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0081', 'color_name' => '紺xｻｯｸｽ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0082', 'color_name' => '紺xﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0084', 'color_name' => 'Wxﾛｲﾔﾙ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0086', 'color_name' => '黒xDﾚｯﾄﾞ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0087', 'color_name' => '黒x蛍黄', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0088', 'color_name' => '黒xｲｴﾛｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0089', 'color_name' => '黒xLﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0090', 'color_name' => '黒xﾛｲﾔﾙ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0091', 'color_name' => 'Dｸﾞﾚｰx黒', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0092', 'color_name' => '赤xﾌﾞﾗｯｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0093', 'color_name' => '黄xDｸﾞﾚｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0095', 'color_name' => '赤xﾎﾜｲﾄ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0098', 'color_name' => 'ｶﾓﾌﾗﾈｲﾋﾞｰ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '0099', 'color_name' => 'ｶﾓﾌﾗﾋﾟﾝｸ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '7708', 'color_name' => 'SDﾌﾞﾙｰMIXB', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '7714', 'color_name' => 'ﾊﾞｰｶﾞﾝMIXB', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '7719', 'color_name' => 'ﾋﾟﾝｸCMIXB', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '7745', 'color_name' => 'ﾁｬｺｰﾙGMIXB', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '8805', 'color_name' => 'ﾛｲﾔﾙMIXW', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '8810', 'color_name' => 'ﾊﾞｰﾐﾘMIXW', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '8834', 'color_name' => 'ﾌﾞﾗｯｸMIXW', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '8841', 'color_name' => 'ﾊﾟｰﾌﾟﾙMIXW', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => '9999', 'color_name' => '', 'sort_order' => '999', 'mt_user_last_update_id' => 1]);
		$model = MtColor::create(['color_cd' => 'ZZZZ', 'color_name' => '', 'sort_order' => '999', 'mt_user_last_update_id' => 1]);
    }

}
