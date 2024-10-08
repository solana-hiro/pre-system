<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefTaxRateKbn;

class DefTaxRateKbnsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	DefTaxRateKbn::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefTaxRateKbn::create(['tax_rate_kbn_cd' => '0', 'tax_rate_kbn_name' => '非課税', 'sort_order' => 0]);
		$model = DefTaxRateKbn::create(['tax_rate_kbn_cd' => '1', 'tax_rate_kbn_name' => '課税', 'sort_order' => 1]);
		$model = DefTaxRateKbn::create(['tax_rate_kbn_cd' => '2', 'tax_rate_kbn_name' => '軽減税率', 'sort_order' => 2]);
		$model = DefTaxRateKbn::create(['tax_rate_kbn_cd' => '8', 'tax_rate_kbn_name' => '経過措置', 'sort_order' => 8]);
		$model = DefTaxRateKbn::create(['tax_rate_kbn_cd' => '9', 'tax_rate_kbn_name' => '免税', 'sort_order' => 9]);
    }

}
