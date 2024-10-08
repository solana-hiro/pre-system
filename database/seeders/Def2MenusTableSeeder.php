<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Def2Menu;

class Def2MenusTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        Def2Menu::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '受注', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '出荷指示', 'sort_order' => '2'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '出荷', 'sort_order' => '3'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '売上', 'sort_order' => '4'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '請求', 'sort_order' => '5'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '売掛', 'sort_order' => '6'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '実績', 'sort_order' => '7'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 1, 'menu_2_name' => '決算', 'sort_order' => '8'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 2, 'menu_2_name' => '発注', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 2, 'menu_2_name' => '仕入', 'sort_order' => '2'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 2, 'menu_2_name' => '支払', 'sort_order' => '3'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 2, 'menu_2_name' => '買掛', 'sort_order' => '4'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 2, 'menu_2_name' => '実績', 'sort_order' => '5'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 2, 'menu_2_name' => '決算', 'sort_order' => '6'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 3, 'menu_2_name' => '在庫', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 3, 'menu_2_name' => '棚卸', 'sort_order' => '2'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 3, 'menu_2_name' => '店舗', 'sort_order' => '3'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 3, 'menu_2_name' => '分析', 'sort_order' => '4'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => '担当', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => '得意先', 'sort_order' => '2'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => '納品先', 'sort_order' => '3'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => '仕入先', 'sort_order' => '4'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => '商品', 'sort_order' => '5'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => '単価', 'sort_order' => '6'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => 'その他', 'sort_order' => '7'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => '展示会', 'sort_order' => '8'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 4, 'menu_2_name' => 'ECマスタ管理', 'sort_order' => '9'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 5, 'menu_2_name' => 'POSCM', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 5, 'menu_2_name' => 'KEYENCE', 'sort_order' => '2'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 5, 'menu_2_name' => 'ALF', 'sort_order' => '3'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 5, 'menu_2_name' => 'CMマスタ管理', 'sort_order' => '4'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 5, 'menu_2_name' => 'CM連携業務', 'sort_order' => '5'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 5, 'menu_2_name' => 'AOEC連携', 'sort_order' => '6'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 5, 'menu_2_name' => '日本郵政', 'sort_order' => '7'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 6, 'menu_2_name' => '更新', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 6, 'menu_2_name' => '復旧', 'sort_order' => '2'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 6, 'menu_2_name' => 'セキュリティ', 'sort_order' => '3'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 6, 'menu_2_name' => '環境設定', 'sort_order' => '4'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 6, 'menu_2_name' => '初期設定', 'sort_order' => '5'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 7, 'menu_2_name' => 'サービス', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 8, 'menu_2_name' => 'Setting', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 9, 'menu_2_name' => 'Gadget1', 'sort_order' => '1'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 9, 'menu_2_name' => 'Gadget2', 'sort_order' => '2'
		]);
		$model = Def2Menu::create([
			'def_1_menu_id' => 9, 'menu_2_name' => 'Gadget3', 'sort_order' => '3'
		]);
    }

}
