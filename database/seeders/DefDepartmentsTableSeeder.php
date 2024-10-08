<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefDepartment;

class DefDepartmentsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefDepartment::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

        $model = DefDepartment::create([
            'department_cd' => '0001',
            'department_name' => '役員',
            'sort_order' => 1,
        ]);
        $model = DefDepartment::create([
            'department_cd' => '0002',
            'department_name' => '管理部',
            'sort_order' => 2,
        ]);
        $model = DefDepartment::create([
            'department_cd' => '0003',
            'department_name' => '営業課',
            'sort_order' => 3,
        ]);
        $model = DefDepartment::create([
            'department_cd' => '0004',
            'department_name' => '生産課',
            'sort_order' => 4,
        ]);
        $model = DefDepartment::create([
            'department_cd' => '0005',
            'department_name' => '業務課',
            'sort_order' => 5,
        ]);
        $model = DefDepartment::create([
            'department_cd' => '0006',
            'department_name' => '物流課',
            'sort_order' => 6,
        ]);
        $model = DefDepartment::create([
            'department_cd' => '0007',
            'department_name' => 'ﾌﾟﾘﾝﾄ事業室',
            'sort_order' => 7,
        ]);
        $model = DefDepartment::create([
            'department_cd' => '9999',
            'department_name' => 'その他',
            'sort_order' => 8,
        ]);
    }

}
