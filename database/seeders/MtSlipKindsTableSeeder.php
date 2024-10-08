<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtSlipKind;

class MtSlipKindsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	MtSlipKind::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '01', 'slip_kind_cd' => '100', 'slip_kind_name' => '受注伝票_6行明細', 'slip_row' => '99', 'paper_width' => '1360', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '100', 'slip_kind_name' => '標準納品書', 'slip_row' => '10', 'paper_width' => '1200', 'paper_height' => '600', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '105', 'slip_kind_name' => 'アラジンオフィス標準', 'slip_row' => '5', 'paper_width' => '1000', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '110', 'slip_kind_name' => 'ｱﾗｼﾞﾝｵﾌｨｽ納品書_6行', 'slip_row' => '6', 'paper_width' => '1000', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '120', 'slip_kind_name' => 'ｱﾗｼﾞﾝｵﾌｨｽ納品書 入数', 'slip_row' => '5', 'paper_width' => '1000', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '130', 'slip_kind_name' => '標準納品書', 'slip_row' => '99', 'paper_width' => '1200', 'paper_height' => '600', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '150', 'slip_kind_name' => 'AO納品書_A4標準3P', 'slip_row' => '5', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '155', 'slip_kind_name' => 'AO納品書_A4入数3P', 'slip_row' => '5', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '160', 'slip_kind_name' => 'AO納品書_A4標準2P', 'slip_row' => '5', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '165', 'slip_kind_name' => 'AO納品書_A4入数2P', 'slip_row' => '5', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '170', 'slip_kind_name' => 'AO納品書_A4明細6行3P', 'slip_row' => '6', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '200', 'slip_kind_name' => 'ﾋｻｺﾞ納品書_BP0101', 'slip_row' => '15', 'paper_width' => '950', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '210', 'slip_kind_name' => 'ﾋｻｺﾞ納品書_BP01023P', 'slip_row' => '5', 'paper_width' => '952.847', 'paper_height' => '452.777', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '220', 'slip_kind_name' => 'ﾋｻｺﾞ納品書_BP01003', 'slip_row' => '5', 'paper_width' => '830', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '300', 'slip_kind_name' => 'コクヨ納品書B6横', 'slip_row' => '7', 'paper_width' => '712.638', 'paper_height' => '503.958', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '310', 'slip_kind_name' => 'ｺｸﾖ納品書_A6横', 'slip_row' => '6', 'paper_width' => '570', 'paper_height' => '413.472', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '400', 'slip_kind_name' => 'ﾁｪｰﾝｽﾄｱ_ﾀｰﾝｱﾗｳﾝﾄﾞ1', 'slip_row' => '6', 'paper_width' => '1150', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '410', 'slip_kind_name' => 'ﾁｪｰﾝｽﾄｱ_ﾀｰﾝｱﾗｳﾝﾄﾞ2', 'slip_row' => '9', 'paper_width' => '1200', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '420', 'slip_kind_name' => 'ﾁｪｰﾝｽﾄｱ_ﾀｲﾌﾟ用', 'slip_row' => '6', 'paper_width' => '1000', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '430', 'slip_kind_name' => 'ﾁｪｰﾝｽﾄｱ_手書き用', 'slip_row' => '6', 'paper_width' => '1050', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '440', 'slip_kind_name' => 'ﾁｪｰﾝｽﾄｱ_OCR用', 'slip_row' => '6', 'paper_width' => '1000', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '450', 'slip_kind_name' => 'ﾁｪｰﾝｽﾄｱ_ﾀｲﾌﾟ用1型', 'slip_row' => '6', 'paper_width' => '1200', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '460', 'slip_kind_name' => '菓子統一伝票', 'slip_row' => '6', 'paper_width' => '1200', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '470', 'slip_kind_name' => '家電統一伝票_E様式', 'slip_row' => '6', 'paper_width' => '1000', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '480', 'slip_kind_name' => '統一伝票_C様式', 'slip_row' => '6', 'paper_width' => '1100', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '490', 'slip_kind_name' => '業際統一伝票', 'slip_row' => '6', 'paper_width' => '1200', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '500', 'slip_kind_name' => '百貨店統一伝票', 'slip_row' => '5', 'paper_width' => '1000', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '510', 'slip_kind_name' => '家具統一伝票', 'slip_row' => '6', 'paper_width' => '1100', 'paper_height' => '500', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '02', 'slip_kind_cd' => '600', 'slip_kind_name' => '納品書600', 'slip_row' => '99', 'paper_width' => '1200', 'paper_height' => '600', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '04', 'slip_kind_cd' => '100', 'slip_kind_name' => '標準発注伝票', 'slip_row' => '99', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '05', 'slip_kind_cd' => '100', 'slip_kind_name' => '標準仕入伝票', 'slip_row' => '6', 'paper_width' => '0', 'paper_height' => '0', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '100', 'slip_kind_name' => 'ヤマト運輸', 'slip_row' => '0', 'paper_width' => '900', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '110', 'slip_kind_name' => '西濃運輸', 'slip_row' => '0', 'paper_width' => '1000', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '120', 'slip_kind_name' => 'カンガルー宅配便', 'slip_row' => '0', 'paper_width' => '1000', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '130', 'slip_kind_name' => '福山通運', 'slip_row' => '0', 'paper_width' => '900', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '140', 'slip_kind_name' => 'ペリカン便', 'slip_row' => '0', 'paper_width' => '800', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '150', 'slip_kind_name' => '佐川急便', 'slip_row' => '0', 'paper_width' => '750', 'paper_height' => '400', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '160', 'slip_kind_name' => 'トナミ運輸', 'slip_row' => '0', 'paper_width' => '1000', 'paper_height' => '400', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '170', 'slip_kind_name' => 'ゆうパック', 'slip_row' => '0', 'paper_width' => '1000', 'paper_height' => '400', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '07', 'slip_kind_cd' => '171', 'slip_kind_name' => '郵パケット', 'slip_row' => '0', 'paper_width' => '1000', 'paper_height' => '400', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '100', 'slip_kind_name' => '標準請求書', 'slip_row' => '26', 'paper_width' => '1250', 'paper_height' => '900', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '105', 'slip_kind_name' => 'ｱﾗｼﾞﾝｵﾌｨｽ請求書_明細', 'slip_row' => '26', 'paper_width' => '1250', 'paper_height' => '900', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '110', 'slip_kind_name' => 'ｱﾗｼﾞﾝｵﾌｨｽ請求書_合計', 'slip_row' => '6', 'paper_width' => '1000', 'paper_height' => '450', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '115', 'slip_kind_name' => '標準請求合計書', 'slip_row' => '0', 'paper_width' => '1250', 'paper_height' => '900', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '150', 'slip_kind_name' => 'AO請求書_A4標準', 'slip_row' => '44', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '200', 'slip_kind_name' => 'ﾋｻｺﾞ請求書_BP0301', 'slip_row' => '6', 'paper_width' => '950', 'paper_height' => '900', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '210', 'slip_kind_name' => 'ﾋｻｺﾞ請求書_BP0304', 'slip_row' => '30', 'paper_width' => '825', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '220', 'slip_kind_name' => 'ﾋｻｺﾞ請求書_BP0306', 'slip_row' => '6', 'paper_width' => '826.875', 'paper_height' => '1169.44', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '300', 'slip_kind_name' => 'ｺｸﾖ請求書_B6横', 'slip_row' => '0', 'paper_width' => '765', 'paper_height' => '502.986', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '09', 'slip_kind_cd' => '310', 'slip_kind_name' => 'ｺｸﾖ請求書_A6横', 'slip_row' => '0', 'paper_width' => '590', 'paper_height' => '412.986', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '10', 'slip_kind_cd' => '100', 'slip_kind_name' => '標準見積伝票', 'slip_row' => '20', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '10', 'slip_kind_cd' => '101', 'slip_kind_name' => '標準＋相手担当者', 'slip_row' => '28', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '10', 'slip_kind_cd' => '105', 'slip_kind_name' => 'アイル見積書A4縦', 'slip_row' => '18', 'paper_width' => '827.013', 'paper_height' => '1170', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '10', 'slip_kind_cd' => '200', 'slip_kind_name' => 'コクヨ見積書B5縦', 'slip_row' => '18', 'paper_width' => '722.013', 'paper_height' => '1011.87', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '11', 'slip_kind_cd' => '100', 'slip_kind_name' => 'ｱﾗｼﾞﾝｵﾌｨｽ荷札', 'slip_row' => '6', 'paper_width' => '1000', 'paper_height' => '400', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
		$model = MtSlipKind::create(['def_slip_kind_kbn_id' => '11', 'slip_kind_cd' => '200', 'slip_kind_name' => 'ｱﾗｼﾞﾝｵﾌｨｽ荷札2', 'slip_row' => '6', 'paper_width' => '1000', 'paper_height' => '400', 'output_kbn' => '0', 'mt_user_last_update_id' => 1]);
    }

}
