<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtRoot;

class MtRootsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtRoot::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = MtRoot::create(['root_cd' => '0003', 'root_name' => 'F 18時集荷', 'sort' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '0004', 'root_name' => 'A 特別', 'sort' => '004', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '0005', 'root_name' => 'K 20時集荷', 'sort' => '005', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '0006', 'root_name' => 'Y 翌日集荷', 'sort' => '006', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '0007', 'root_name' => '〒 個人宅', 'sort' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '0008', 'root_name' => 'O 沖縄便', 'sort' => '007', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '0009', 'root_name' => 'R 離島便', 'sort' => '008', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '0010', 'root_name' => 'B 追加少', 'sort' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '8001', 'root_name' => 'T トムス受託出荷', 'sort' => '009', 'mt_user_last_update_id' => 1]);
		$model = MtRoot::create(['root_cd' => '9999', 'root_name' => '未設定', 'sort' => '999', 'mt_user_last_update_id' => 1]);
    }

}
