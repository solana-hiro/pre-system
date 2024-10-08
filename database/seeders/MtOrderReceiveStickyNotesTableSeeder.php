<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MtOrderReceiveStickyNote;

class MtOrderReceiveStickyNotesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	MtOrderReceiveStickyNote::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェック有効

		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '0', 'sticky_note_color' => '', 'sticky_note_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '1', 'sticky_note_color' => '#FEFE00', 'sticky_note_name' => '入金後先', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '2', 'sticky_note_color' => '#FE0000', 'sticky_note_name' => '支払不良　危険A', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '3', 'sticky_note_color' => '#FE00FE', 'sticky_note_name' => '支払不良　危険B', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '4', 'sticky_note_color' => '#FE8080', 'sticky_note_name' => '支払不良　危険C', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '5', 'sticky_note_color' => '#0000FE', 'sticky_note_name' => '口座抹消', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '6', 'sticky_note_color' => '#0080C0', 'sticky_note_name' => '取引停止中', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '7', 'sticky_note_color' => '#80FEFE', 'sticky_note_name' => '出荷停止中', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '8', 'sticky_note_color' => '#008000', 'sticky_note_name' => '業務ルールあり', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '9', 'sticky_note_color' => '#000000', 'sticky_note_name' => '倒産', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '1', 'branch_number' => '10', 'sticky_note_color' => '#FEFEFE', 'sticky_note_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '0', 'sticky_note_color' => '', 'sticky_note_name' => '(付箋なしを示す)', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '1', 'sticky_note_color' => '#FE80FE', 'sticky_note_name' => '連絡あり', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '2', 'sticky_note_color' => '#00FE40', 'sticky_note_name' => 'キャンセル', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '3', 'sticky_note_color' => '#FE8000', 'sticky_note_name' => '揃い出し', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '4', 'sticky_note_color' => '#008040', 'sticky_note_name' => '日時指定', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '5', 'sticky_note_color' => '#808080', 'sticky_note_name' => '欠品キャンセル', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '6', 'sticky_note_color' => '#004080', 'sticky_note_name' => '期限切れキャンセル', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '7', 'sticky_note_color' => '#FE0000', 'sticky_note_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '8', 'sticky_note_color' => '#FEFEFE', 'sticky_note_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '9', 'sticky_note_color' => '#800080', 'sticky_note_name' => 'マーキング', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '10', 'sticky_note_color' => '#0080FE', 'sticky_note_name' => '', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '0', 'sticky_note_color' => '', 'sticky_note_name' => '(付箋なしを示す)', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '1', 'sticky_note_color' => '#FE0000', 'sticky_note_name' => 'EC在庫無し', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '2', 'sticky_note_color' => '#FE8000', 'sticky_note_name' => '欠品', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '3', 'sticky_note_color' => '#FE00FE', 'sticky_note_name' => '受注残入荷済', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '4', 'sticky_note_color' => '#0080C0', 'sticky_note_name' => 'キャンセル', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '5', 'sticky_note_color' => '#FEFE00', 'sticky_note_name' => '変更', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '6', 'sticky_note_color' => '#00FE00', 'sticky_note_name' => '受注残', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '7', 'sticky_note_color' => '#004080', 'sticky_note_name' => '受注残（入金案内済）', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '8', 'sticky_note_color' => '#008080', 'sticky_note_name' => '受注残（入金済）', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '9', 'sticky_note_color' => '#800080', 'sticky_note_name' => 'ｗオフィス在庫無し', 'mt_user_last_update_id' => 1]);
		$model = MtOrderReceiveStickyNote::create(['def_sticky_note_kind_id' => '2', 'branch_number' => '10', 'sticky_note_color' => '#C0C0C0', 'sticky_note_name' => 'トータルピッキング済', 'mt_user_last_update_id' => 1]);
    }

}
