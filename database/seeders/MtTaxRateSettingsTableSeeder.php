<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtTaxRateSetting;

class MtTaxRateSettingsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	MtTaxRateSetting::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '1', 'application_start_date' => '1989-04-01', 'tax_rate' => 0.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '2', 'application_start_date' => '1989-04-01', 'tax_rate' => 3.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '2', 'application_start_date' => '1997-04-01', 'tax_rate' => 5.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '2', 'application_start_date' => '2014-04-01', 'tax_rate' => 8.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '2', 'application_start_date' => '2019-10-01', 'tax_rate' => 10.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '3', 'application_start_date' => '2014-04-01', 'tax_rate' => 8.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '3', 'application_start_date' => '2019-10-01', 'tax_rate' => 8.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '4', 'application_start_date' => '2019-10-01', 'tax_rate' => 8.00, 'mt_user_last_update_id' => 1]);
		$model = MtTaxRateSetting::create(['def_tax_rate_kbn_id' => '5', 'application_start_date' => '1989-04-01', 'tax_rate' => 0.00, 'mt_user_last_update_id' => 1]);
    }

}
