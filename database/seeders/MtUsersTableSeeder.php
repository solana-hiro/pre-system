<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtUser;

class MtUsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtUser::truncate();

		$model = MtUser::create(['user_cd' => '0001', 'user_name' => 'テスト花子', 'user_name_kana' => 'テストハナコ', 'password' => bcrypt('123123123'), 'def_department_id' => 1, 'mt_user_last_update_id' => 1, 'validity_flg' => 1]);
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

    }

}
