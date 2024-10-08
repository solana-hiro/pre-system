<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Def1Menu;

class Def1MenusTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        Def1Menu::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

        $model = Def1Menu::create([
            'menu_1_name' => '販売管理',
            'sort_order' => 1,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => '購買管理',
            'sort_order' => 2,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => '在庫管理',
            'sort_order' => 3,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => 'マスタ管理',
            'sort_order' => 4,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => '連携',
            'sort_order' => 5,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => 'システム',
            'sort_order' => 6,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => 'お気に入り',
            'sort_order' => 7,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => 'DBoard',
            'sort_order' => 8,
        ]);
        $model = Def1Menu::create([
            'menu_1_name' => 'DBoard',
            'sort_order' => 9,
        ]);
    }

}
