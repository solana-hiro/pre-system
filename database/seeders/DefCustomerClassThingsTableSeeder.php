<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefCustomerClassThing;

class DefCustomerClassThingsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefCustomerClassThing::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefCustomerClassThing::create(['customer_class_thing_name' => '販売パターン１', 'sort_order' => 1]);
		$model = DefCustomerClassThing::create(['customer_class_thing_name' => '業種・特徴２', 'sort_order' => 2]);
		$model = DefCustomerClassThing::create(['customer_class_thing_name' => 'ランク３', 'sort_order' => 3]);
    }

}
