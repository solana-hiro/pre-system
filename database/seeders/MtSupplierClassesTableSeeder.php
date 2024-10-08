<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtSupplierClass;

class MtSupplierClassesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtSupplierClass::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = MtSupplierClass::create(['def_supplier_class_thing_id' => 1, 'supplier_class_cd' => '0001', 'supplier_class_name' => '日本', 'mt_user_last_update_id' => 1]);
		$model = MtSupplierClass::create(['def_supplier_class_thing_id' => 1, 'supplier_class_cd' => '0002', 'supplier_class_name' => '中国', 'mt_user_last_update_id' => 1]);
		$model = MtSupplierClass::create(['def_supplier_class_thing_id' => 1, 'supplier_class_cd' => '0003', 'supplier_class_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtSupplierClass::create(['def_supplier_class_thing_id' => 1, 'supplier_class_cd' => '0004', 'supplier_class_name' => 'バングラディシュ', 'mt_user_last_update_id' => 1]);
		$model = MtSupplierClass::create(['def_supplier_class_thing_id' => 1, 'supplier_class_cd' => '0005', 'supplier_class_name' => 'カンボジア', 'mt_user_last_update_id' => 1]);
		$model = MtSupplierClass::create(['def_supplier_class_thing_id' => 1, 'supplier_class_cd' => '0099', 'supplier_class_name' => 'その他', 'mt_user_last_update_id' => 1]);
    }

}
