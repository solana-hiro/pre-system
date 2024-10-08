<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtBank;

class MtBanksTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtBank::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = MtBank::create(['bank_cd' => '0005', 'bank_name' => '三菱UFJ', 'mt_user_last_update_id' => 1]);
		$model = MtBank::create(['bank_cd' => '0007', 'bank_name' => '東京三菱　外貨', 'mt_user_last_update_id' => 1]);
		$model = MtBank::create(['bank_cd' => '0010', 'bank_name' => 'りそな No0268216', 'mt_user_last_update_id' => 1]);
		$model = MtBank::create(['bank_cd' => '0011', 'bank_name' => 'りそな No1416889', 'mt_user_last_update_id' => 1]);
		$model = MtBank::create(['bank_cd' => '0012', 'bank_name' => 'りそな　外貨', 'mt_user_last_update_id' => 1]);
    }

}
