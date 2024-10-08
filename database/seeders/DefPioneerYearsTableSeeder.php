<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefPioneerYear;

class DefPioneerYearsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefPioneerYear::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefPioneerYear::create(['pioneer_year_cd' => '0006', 'pioneer_year_name' => '006-従来店', 'sort_order' => 6]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0007', 'pioneer_year_name' => '007-平成7年', 'sort_order' => 7]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0008', 'pioneer_year_name' => '008-平成8年', 'sort_order' => 8]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0009', 'pioneer_year_name' => '009-平成9年', 'sort_order' => 9]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0010', 'pioneer_year_name' => '010-平成10年', 'sort_order' => 10]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0011', 'pioneer_year_name' => '011-平成11年', 'sort_order' => 11]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0012', 'pioneer_year_name' => '012-平成12年', 'sort_order' => 12]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0013', 'pioneer_year_name' => '013-平成13年', 'sort_order' => 13]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0014', 'pioneer_year_name' => '014-平成14年', 'sort_order' => 14]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0015', 'pioneer_year_name' => '015-平成15年', 'sort_order' => 15]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0016', 'pioneer_year_name' => '016-平成16年', 'sort_order' => 16]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0017', 'pioneer_year_name' => '017-平成17年', 'sort_order' => 17]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0018', 'pioneer_year_name' => '018-平成18年', 'sort_order' => 18]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0019', 'pioneer_year_name' => '019-平成19年', 'sort_order' => 19]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0020', 'pioneer_year_name' => '020-平成20年', 'sort_order' => 20]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0021', 'pioneer_year_name' => '021-平成21年', 'sort_order' => 21]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0022', 'pioneer_year_name' => '022-平成22年', 'sort_order' => 22]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0023', 'pioneer_year_name' => '023-平成23年', 'sort_order' => 23]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0024', 'pioneer_year_name' => '024-平成24年', 'sort_order' => 24]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0025', 'pioneer_year_name' => '025-平成25年', 'sort_order' => 25]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0026', 'pioneer_year_name' => '026-平成26年', 'sort_order' => 26]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0027', 'pioneer_year_name' => '027-平成27年', 'sort_order' => 27]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0028', 'pioneer_year_name' => '028-平成28年', 'sort_order' => 28]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0029', 'pioneer_year_name' => '029-平成29年', 'sort_order' => 29]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0030', 'pioneer_year_name' => '030-平成30年', 'sort_order' => 30]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0031', 'pioneer_year_name' => '031-平成31年/令和1年', 'sort_order' => 31]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0032', 'pioneer_year_name' => '032-令和2年', 'sort_order' => 32]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0033', 'pioneer_year_name' => '033-令和3年', 'sort_order' => 33]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0034', 'pioneer_year_name' => '034-令和4年', 'sort_order' => 34]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0035', 'pioneer_year_name' => '035-令和5年', 'sort_order' => 35]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0500', 'pioneer_year_name' => '500-支店', 'sort_order' => 500]);
		$model = DefPioneerYear::create(['pioneer_year_cd' => '0999', 'pioneer_year_name' => '999-その他', 'sort_order' => 999]);
    }

}
