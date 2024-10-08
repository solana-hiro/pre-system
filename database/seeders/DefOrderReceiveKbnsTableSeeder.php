<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefOrderReceiveKbn;

class DefOrderReceiveKbnsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	DefOrderReceiveKbn::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefOrderReceiveKbn::create(['order_receive_kbn_cd' => '01', 'order_receive_kbn_name' => '売上', 'sort_order' => 0]);
		$model = DefOrderReceiveKbn::create(['order_receive_kbn_cd' => '04', 'order_receive_kbn_name' => '運賃', 'sort_order' => 1]);
    }

}
