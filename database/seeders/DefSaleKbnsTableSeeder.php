<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DeSaleKbn;

class DefSaleKbnsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	DefSaleKbn::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = DefPsKbn::create(['sale_kbn_cd' => '01', 'sale_kbn_name' => '売上', 'sort_order' => 1]);
		$model = DefPsKbn::create(['sale_kbn_cd' => '02', 'sale_kbn_name' => '返品', 'sort_order' => 2]);
		$model = DefPsKbn::create(['sale_kbn_cd' => '03', 'sale_kbn_name' => '値引', 'sort_order' => 3]);
		$model = DefPsKbn::create(['sale_kbn_cd' => '04', 'sale_kbn_name' => '運賃', 'sort_order' => 4]);
		$model = DefPsKbn::create(['sale_kbn_cd' => '05', 'sale_kbn_name' => '他', 'sort_order' => 5]);
		$model = DefPsKbn::create(['sale_kbn_cd' => '06', 'sale_kbn_name' => '品値引', 'sort_order' => 6]);
    }

}
