<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefItemClassThing;

class DefItemClassThingsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefItemClassThing::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefItemClassThing::create(['item_class_thing_name' => 'ブランド1', 'sort_order' => 1]);
		$model = DefItemClassThing::create(['item_class_thing_name' => '競技・カテゴリ', 'sort_order' => 2]);
		$model = DefItemClassThing::create(['item_class_thing_name' => 'ジャンル', 'sort_order' => 3]);
		$model = DefItemClassThing::create(['item_class_thing_name' => '販売開始年', 'sort_order' => 4]);
		$model = DefItemClassThing::create(['item_class_thing_name' => '工場分類5', 'sort_order' => 5]);
		$model = DefItemClassThing::create(['item_class_thing_name' => '製品/工賃6', 'sort_order' => 6]);
		$model = DefItemClassThing::create(['item_class_thing_name' => '資産在庫JA', 'sort_order' => 7]);

    }

}
