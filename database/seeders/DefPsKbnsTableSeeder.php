<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefPsKbn;

class DefPsKbnsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	DefPsKbn::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefPsKbn::create(['ps_kbn_cd' => '0', 'ps_kbn_name' => 'プロパー', 'sort_order' => 1]);
		$model = DefPsKbn::create(['ps_kbn_cd' => '1', 'ps_kbn_name' => 'セール', 'sort_order' => 2]);
    }

}
