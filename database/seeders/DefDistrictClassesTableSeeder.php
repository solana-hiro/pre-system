<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefDistrictClass;

class DefDistrictClassesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
        DefDistrictClass::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefDistrictClass::create(['district_class_cd' => '0001', 'district_class_name' => '01-北海道', 'sort_order' => 1]);
		$model = DefDistrictClass::create(['district_class_cd' => '0002', 'district_class_name' => '02-青森県', 'sort_order' => 2]);
		$model = DefDistrictClass::create(['district_class_cd' => '0003', 'district_class_name' => '03-岩手県', 'sort_order' => 3]);
		$model = DefDistrictClass::create(['district_class_cd' => '0004', 'district_class_name' => '04-宮城県', 'sort_order' => 4]);
		$model = DefDistrictClass::create(['district_class_cd' => '0005', 'district_class_name' => '05-秋田県', 'sort_order' => 5]);
		$model = DefDistrictClass::create(['district_class_cd' => '0006', 'district_class_name' => '06-山形県', 'sort_order' => 6]);
		$model = DefDistrictClass::create(['district_class_cd' => '0007', 'district_class_name' => '07-福島県', 'sort_order' => 7]);
		$model = DefDistrictClass::create(['district_class_cd' => '0008', 'district_class_name' => '08-茨城県', 'sort_order' => 8]);
		$model = DefDistrictClass::create(['district_class_cd' => '0009', 'district_class_name' => '09-栃木県', 'sort_order' => 9]);
		$model = DefDistrictClass::create(['district_class_cd' => '0010', 'district_class_name' => '10-群馬県', 'sort_order' => 10]);
		$model = DefDistrictClass::create(['district_class_cd' => '0011', 'district_class_name' => '11-埼玉県', 'sort_order' => 11]);
		$model = DefDistrictClass::create(['district_class_cd' => '0012', 'district_class_name' => '12-千葉県', 'sort_order' => 12]);
		$model = DefDistrictClass::create(['district_class_cd' => '0014', 'district_class_name' => '14-神奈川県', 'sort_order' => 14]);
		$model = DefDistrictClass::create(['district_class_cd' => '0015', 'district_class_name' => '15-新潟県', 'sort_order' => 15]);
		$model = DefDistrictClass::create(['district_class_cd' => '0016', 'district_class_name' => '16-富山県', 'sort_order' => 16]);
		$model = DefDistrictClass::create(['district_class_cd' => '0017', 'district_class_name' => '17-石川県', 'sort_order' => 17]);
		$model = DefDistrictClass::create(['district_class_cd' => '0018', 'district_class_name' => '18-福井県', 'sort_order' => 18]);
		$model = DefDistrictClass::create(['district_class_cd' => '0019', 'district_class_name' => '19-山梨県', 'sort_order' => 19]);
		$model = DefDistrictClass::create(['district_class_cd' => '0020', 'district_class_name' => '20-長野県', 'sort_order' => 20]);
		$model = DefDistrictClass::create(['district_class_cd' => '0021', 'district_class_name' => '21-岐阜県', 'sort_order' => 21]);
		$model = DefDistrictClass::create(['district_class_cd' => '0022', 'district_class_name' => '22-静岡県', 'sort_order' => 22]);
		$model = DefDistrictClass::create(['district_class_cd' => '0023', 'district_class_name' => '23-愛知県', 'sort_order' => 23]);
		$model = DefDistrictClass::create(['district_class_cd' => '0024', 'district_class_name' => '24-三重県', 'sort_order' => 24]);
		$model = DefDistrictClass::create(['district_class_cd' => '0025', 'district_class_name' => '25-滋賀県', 'sort_order' => 25]);
		$model = DefDistrictClass::create(['district_class_cd' => '0026', 'district_class_name' => '26-京都府', 'sort_order' => 26]);
		$model = DefDistrictClass::create(['district_class_cd' => '0027', 'district_class_name' => '27-大阪府', 'sort_order' => 27]);
		$model = DefDistrictClass::create(['district_class_cd' => '0028', 'district_class_name' => '28-兵庫県', 'sort_order' => 28]);
		$model = DefDistrictClass::create(['district_class_cd' => '0029', 'district_class_name' => '29-奈良県', 'sort_order' => 29]);
		$model = DefDistrictClass::create(['district_class_cd' => '0030', 'district_class_name' => '30-和歌山県', 'sort_order' => 30]);
		$model = DefDistrictClass::create(['district_class_cd' => '0031', 'district_class_name' => '31-鳥取県', 'sort_order' => 31]);
		$model = DefDistrictClass::create(['district_class_cd' => '0032', 'district_class_name' => '32-島根県', 'sort_order' => 32]);
		$model = DefDistrictClass::create(['district_class_cd' => '0033', 'district_class_name' => '33-岡山県', 'sort_order' => 33]);
		$model = DefDistrictClass::create(['district_class_cd' => '0034', 'district_class_name' => '34-広島県', 'sort_order' => 34]);
		$model = DefDistrictClass::create(['district_class_cd' => '0035', 'district_class_name' => '35-山口県', 'sort_order' => 35]);
		$model = DefDistrictClass::create(['district_class_cd' => '0036', 'district_class_name' => '36-徳島県', 'sort_order' => 36]);
		$model = DefDistrictClass::create(['district_class_cd' => '0037', 'district_class_name' => '37-香川県', 'sort_order' => 37]);
		$model = DefDistrictClass::create(['district_class_cd' => '0038', 'district_class_name' => '38-愛媛県', 'sort_order' => 38]);
		$model = DefDistrictClass::create(['district_class_cd' => '0039', 'district_class_name' => '39-高知県', 'sort_order' => 39]);
		$model = DefDistrictClass::create(['district_class_cd' => '0040', 'district_class_name' => '40-福岡県', 'sort_order' => 40]);
		$model = DefDistrictClass::create(['district_class_cd' => '0041', 'district_class_name' => '41-佐賀県', 'sort_order' => 41]);
		$model = DefDistrictClass::create(['district_class_cd' => '0042', 'district_class_name' => '42-長崎県', 'sort_order' => 42]);
		$model = DefDistrictClass::create(['district_class_cd' => '0043', 'district_class_name' => '43-熊本県', 'sort_order' => 43]);
		$model = DefDistrictClass::create(['district_class_cd' => '0044', 'district_class_name' => '44-大分県', 'sort_order' => 44]);
		$model = DefDistrictClass::create(['district_class_cd' => '0045', 'district_class_name' => '45-宮崎県', 'sort_order' => 45]);
		$model = DefDistrictClass::create(['district_class_cd' => '0046', 'district_class_name' => '46-鹿児島県', 'sort_order' => 46]);
		$model = DefDistrictClass::create(['district_class_cd' => '0047', 'district_class_name' => '47-沖縄県', 'sort_order' => 47]);
		$model = DefDistrictClass::create(['district_class_cd' => '0048', 'district_class_name' => '48-東京都城西地区', 'sort_order' => 48]);
		$model = DefDistrictClass::create(['district_class_cd' => '0049', 'district_class_name' => '49-東京都城南地区', 'sort_order' => 49]);
		$model = DefDistrictClass::create(['district_class_cd' => '0050', 'district_class_name' => '50-東京都下地区', 'sort_order' => 50]);
		$model = DefDistrictClass::create(['district_class_cd' => '0051', 'district_class_name' => '51-東京都城東中心', 'sort_order' => 51]);
		$model = DefDistrictClass::create(['district_class_cd' => '0052', 'district_class_name' => '52-東京都城東外環', 'sort_order' => 52]);
		$model = DefDistrictClass::create(['district_class_cd' => '0099', 'district_class_name' => '99-その他', 'sort_order' => 99]);
    }

}
