<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefSlipKindKbn;

class DefSlipKindKbnsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	DefSlipKindKbn::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '01', 'slip_kind_kbn_name' => '受注', 'sort_order' => 1]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '02', 'slip_kind_kbn_name' => '売上', 'sort_order' => 2]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '03', 'slip_kind_kbn_name' => '入金', 'sort_order' => 3]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '04', 'slip_kind_kbn_name' => '発注', 'sort_order' => 4]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '05', 'slip_kind_kbn_name' => '仕入', 'sort_order' => 5]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '06', 'slip_kind_kbn_name' => '支払', 'sort_order' => 6]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '07', 'slip_kind_kbn_name' => '送り状', 'sort_order' => 7]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '08', 'slip_kind_kbn_name' => '入出庫', 'sort_order' => 8]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '09', 'slip_kind_kbn_name' => '請求書', 'sort_order' => 9]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '10', 'slip_kind_kbn_name' => '見積', 'sort_order' => 14]);
		$model = DefSlipKindKbn::create(['slip_kind_kbn_cd' => '11', 'slip_kind_kbn_name' => '荷札', 'sort_order' => 17]);
    }

}
