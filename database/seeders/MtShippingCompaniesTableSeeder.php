<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtShippingCompany;

class MtShippingCompaniesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtShippingCompany::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = MtShippingCompany::create(['shipping_company_cd' => '0001', 'shipping_company_name' => '福山通運', 'mt_slip_kind7_id' => '35', 'mt_slip_kind17_id' => '55', 'mt_user_last_update_id' => 1]);
		$model = MtShippingCompany::create(['shipping_company_cd' => '0002', 'shipping_company_name' => 'ヤマト運輸', 'mt_slip_kind7_id' => '32', 'mt_slip_kind17_id' => '55', 'mt_user_last_update_id' => 1]);
		$model = MtShippingCompany::create(['shipping_company_cd' => '0003', 'shipping_company_name' => '佐川急便', 'mt_slip_kind7_id' => '37', 'mt_slip_kind17_id' => '55', 'mt_user_last_update_id' => 1]);
		$model = MtShippingCompany::create(['shipping_company_cd' => '0004', 'shipping_company_name' => 'ゆうパック', 'mt_slip_kind7_id' => '39', 'mt_slip_kind17_id' => '55', 'mt_user_last_update_id' => 1]);
		$model = MtShippingCompany::create(['shipping_company_cd' => '0005', 'shipping_company_name' => '郵パケット(ﾎﾟｽﾄ投函)', 'mt_slip_kind7_id' => '40', 'mt_slip_kind17_id' => '56', 'mt_user_last_update_id' => 1]);
		$model = MtShippingCompany::create(['shipping_company_cd' => '0100', 'shipping_company_name' => 'ゆうパック(委託)', 'mt_slip_kind7_id' => '39', 'mt_slip_kind17_id' => '56', 'mt_user_last_update_id' => 1]);
		$model = MtShippingCompany::create(['shipping_company_cd' => '2100', 'shipping_company_name' => 'ゆうパケット(委託)', 'mt_slip_kind7_id' => '40', 'mt_slip_kind17_id' => '55', 'mt_user_last_update_id' => 1]);
		$model = MtShippingCompany::create(['shipping_company_cd' => '8001', 'shipping_company_name' => 'ＤＰご来社', 'mt_slip_kind7_id' => '35', 'mt_slip_kind17_id' => '55', 'mt_user_last_update_id' => 1]);

        Schema::enableForeignKeyConstraints();  //外部キーチェック有効
    }

}
