<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtSize;

class MtSizesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        MtSize::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = MtSize::create(['size_cd' => '0009 ', 'size_name' => '90', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0010 ', 'size_name' => '100', 'sort_order' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0011 ', 'size_name' => '110', 'sort_order' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0012 ', 'size_name' => '120', 'sort_order' => '004', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0013 ', 'size_name' => '130', 'sort_order' => '005', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0014 ', 'size_name' => '140', 'sort_order' => '006', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0015 ', 'size_name' => '150', 'sort_order' => '007', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0016 ', 'size_name' => '160', 'sort_order' => '009', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0021 ', 'size_name' => 'ＸＳ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0022 ', 'size_name' => 'Ｓ', 'sort_order' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0023 ', 'size_name' => 'Ｍ', 'sort_order' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0024 ', 'size_name' => 'Ｌ', 'sort_order' => '004', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0025 ', 'size_name' => 'ＸＬ', 'sort_order' => '005', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0026 ', 'size_name' => 'ＸＸＬ', 'sort_order' => '006', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0027 ', 'size_name' => '３ＸＬ', 'sort_order' => '007', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0028 ', 'size_name' => '４ＸＬ', 'sort_order' => '008', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0029 ', 'size_name' => '５ＸＬ', 'sort_order' => '009', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0030 ', 'size_name' => '６ＸＬ', 'sort_order' => '010', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0031 ', 'size_name' => 'ＪＳ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0032 ', 'size_name' => 'ＪＭ', 'sort_order' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0033 ', 'size_name' => 'ＪＬ', 'sort_order' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0043 ', 'size_name' => '×　ＪＳ　', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0044 ', 'size_name' => '×　ＪＭ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0045 ', 'size_name' => '×　ＪＬ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0046 ', 'size_name' => '×　ＪＯ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0052 ', 'size_name' => '×　Ｓ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0053 ', 'size_name' => '×　Ｍ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0054 ', 'size_name' => '×　Ｌ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0055 ', 'size_name' => '×　ＬＬ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0056 ', 'size_name' => '×　３Ｌ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0057 ', 'size_name' => '×　４Ｌ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0058 ', 'size_name' => '×　５Ｌ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0059 ', 'size_name' => '×　６Ｌ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0060 ', 'size_name' => '×　７Ｌ', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0073 ', 'size_name' => '100(３号)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0074 ', 'size_name' => '110(４号)', 'sort_order' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0075 ', 'size_name' => '120(５号)', 'sort_order' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0076 ', 'size_name' => '130(６号)', 'sort_order' => '004', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0080 ', 'size_name' => '７ＸＬ', 'sort_order' => '011', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '0081 ', 'size_name' => '８ＸＬ', 'sort_order' => '012', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '1052 ', 'size_name' => '52cm', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '1054 ', 'size_name' => '54cm', 'sort_order' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '1056 ', 'size_name' => '56cm', 'sort_order' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '1057 ', 'size_name' => '57cm', 'sort_order' => '004', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '1058 ', 'size_name' => '58cm', 'sort_order' => '005', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '1060 ', 'size_name' => '60cm', 'sort_order' => '006', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '1105 ', 'size_name' => 'L(105cm)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '2016 ', 'size_name' => '16～18', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '2019 ', 'size_name' => '19～21', 'sort_order' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '2022 ', 'size_name' => '22～24', 'sort_order' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '2025 ', 'size_name' => '25～27', 'sort_order' => '004', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3022 ', 'size_name' => 'S(A/B)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3023 ', 'size_name' => 'S(C/D)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3024 ', 'size_name' => 'M(A/B)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3025 ', 'size_name' => 'M(C/D)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3026 ', 'size_name' => 'L(A/B)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3027 ', 'size_name' => 'L(C/D)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3028 ', 'size_name' => 'XL(A/B)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3029 ', 'size_name' => 'XL(C/D)', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3081 ', 'size_name' => 'A/B', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '3082 ', 'size_name' => 'C/D', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4150 ', 'size_name' => '15.0cm', 'sort_order' => '001', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4155 ', 'size_name' => '15.5cm', 'sort_order' => '002', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4160 ', 'size_name' => '16.0cm', 'sort_order' => '003', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4165 ', 'size_name' => '16.5cm', 'sort_order' => '004', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4170 ', 'size_name' => '17.0cm', 'sort_order' => '005', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4175 ', 'size_name' => '17.5cm', 'sort_order' => '006', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4180 ', 'size_name' => '18.0cm', 'sort_order' => '007', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4185 ', 'size_name' => '18.5cm', 'sort_order' => '008', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4190 ', 'size_name' => '19.0cm', 'sort_order' => '009', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4195 ', 'size_name' => '19.5cm', 'sort_order' => '010', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4200 ', 'size_name' => '20.0cm', 'sort_order' => '011', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4205 ', 'size_name' => '20.5cm', 'sort_order' => '012', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4210 ', 'size_name' => '21.0cm', 'sort_order' => '013', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4215 ', 'size_name' => '21.5cm', 'sort_order' => '014', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4220 ', 'size_name' => '22.0cm', 'sort_order' => '015', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4225 ', 'size_name' => '22.5cm', 'sort_order' => '016', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4230 ', 'size_name' => '23.0cm', 'sort_order' => '017', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4235 ', 'size_name' => '23.5cm', 'sort_order' => '018', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4240 ', 'size_name' => '24.0cm', 'sort_order' => '019', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4245 ', 'size_name' => '24.5cm', 'sort_order' => '020', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4250 ', 'size_name' => '25.0cm', 'sort_order' => '021', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4255 ', 'size_name' => '25.5cm', 'sort_order' => '022', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4260 ', 'size_name' => '26.0cm', 'sort_order' => '023', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4265 ', 'size_name' => '26.5cm', 'sort_order' => '024', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4270 ', 'size_name' => '27.0cm', 'sort_order' => '025', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4275 ', 'size_name' => '27.5cm', 'sort_order' => '026', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4280 ', 'size_name' => '28.0cm', 'sort_order' => '027', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4285 ', 'size_name' => '28.5cm', 'sort_order' => '028', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4290 ', 'size_name' => '29.0cm', 'sort_order' => '029', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4295 ', 'size_name' => '29.5cm', 'sort_order' => '030', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '4300 ', 'size_name' => '30.0cm', 'sort_order' => '031', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => '9999 ', 'size_name' => '', 'sort_order' => '999', 'mt_user_last_update_id' => 1]);
		$model = MtSize::create(['size_cd' => 'ZZZZ', 'size_name' => '', 'sort_order' => '999', 'mt_user_last_update_id' => 1]);
    }

}
