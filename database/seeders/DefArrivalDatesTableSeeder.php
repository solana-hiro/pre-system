<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefArrivalDate;

class DefArrivalDatesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefArrivalDate::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefArrivalDate::create(['arrival_date_cd' => '0001', 'arrival_date_name' => '翌日着', 'sort_order' => 1]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0002', 'arrival_date_name' => '翌日ＡＭ着', 'sort_order' => 2]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0003', 'arrival_date_name' => '翌日着（日祝配達無し）', 'sort_order' => 3]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0004', 'arrival_date_name' => '中1日着', 'sort_order' => 4]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0005', 'arrival_date_name' => '中1日ＡＭ着', 'sort_order' => 5]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0006', 'arrival_date_name' => '中1日着（日祝配達無し）', 'sort_order' => 6]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0007', 'arrival_date_name' => '中2日着', 'sort_order' => 7]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0008', 'arrival_date_name' => '中2日ＡＭ着', 'sort_order' => 8]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0009', 'arrival_date_name' => '中2日着（日祝配達無し）', 'sort_order' => 9]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0012', 'arrival_date_name' => '福山航空便/郵パック', 'sort_order' => 12]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0013', 'arrival_date_name' => '郵パック', 'sort_order' => 13]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0016', 'arrival_date_name' => '福山航空/郵ﾊﾟｯｸ(日祝配達無)', 'sort_order' => 16]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0017', 'arrival_date_name' => '福山航空/郵ﾊﾟｯｸ(日配達無し)', 'sort_order' => 17]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0023', 'arrival_date_name' => '中3日着', 'sort_order' => 23]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0024', 'arrival_date_name' => '中4日着', 'sort_order' => 24]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0025', 'arrival_date_name' => '中5日着', 'sort_order' => 25]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0026', 'arrival_date_name' => '中3日着（日祝配達無し）', 'sort_order' => 26]);
		$model = DefArrivalDate::create(['arrival_date_cd' => '0050', 'arrival_date_name' => '翌日着 11－3月〒 4-12月福山', 'sort_order' => 50]);

    }

}
