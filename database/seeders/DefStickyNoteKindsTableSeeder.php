<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\DefStickyNoteKind;

class DefStickyNoteKindsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェック無効
    	DefStickyNoteKind::truncate();
        Schema::enableForeignKeyConstraints();  //外部キーチェック有効

		$model = DefStickyNoteKind::create(['sticky_note_kind_cd' => '1', 'sticky_note_kind_name' => '得意先特記事項用', 'sort_order' => 1]);
		$model = DefStickyNoteKind::create(['sticky_note_kind_cd' => '2', 'sticky_note_kind_name' => '受注伝票ヘッダ用', 'sort_order' => 2]);
		$model = DefStickyNoteKind::create(['sticky_note_kind_cd' => '3', 'sticky_note_kind_name' => '受注伝票明細用', 'sort_order' => 3]);
    }

}
