<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefSupplierClassThing;

class DefSupplierClassThingsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefSupplierClassThing::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefSupplierClassThing::create(['supplier_class_thing_name' => '仕入先分類１', 'sort_order' => 1]);
		$model = DefSupplierClassThing::create(['supplier_class_thing_name' => '仕入先分類２', 'sort_order' => 2]);
		$model = DefSupplierClassThing::create(['supplier_class_thing_name' => '仕入先分類３', 'sort_order' => 3]);
    }

}
