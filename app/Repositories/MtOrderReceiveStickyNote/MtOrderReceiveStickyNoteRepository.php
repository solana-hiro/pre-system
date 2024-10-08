<?php
namespace App\Repositories\MtOrderReceiveStickyNote;

use App\Models\MtOrderReceiveStickyNote;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtOrderReceiveStickyNoteRepository implements MtOrderReceiveStickyNoteRepositoryInterface
{

    /**
     * 受付付箋情報取得 全件取得
     * @return Object
     */
    public function getAll() {
		$result = MtOrderReceiveStickyNote::get();
		return $result;
    }

    /**
     * 受付付箋情報　初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtOrderReceiveStickyNote::get();
        return $result;
    }

    public function getStickyNotesForReceiveOrder()
    {
        $result = MtOrderReceiveStickyNote::where('def_sticky_note_kind_id', 2)->whereNotNull('sticky_note_name')->where('sticky_note_name', '!=', '')->get();
        return $result;
    }

    /**
     * 受付付箋情報 更新
     * @param $params
     * @return Object
     */
    public function update($params) {
        $result = array();
        try {
            DB::beginTransaction();
            $j = 0;
            if($params['def_sticky_note_kind_id'] === '1') {
                foreach ($params['update_id1'] as $param) {
                    if (!empty($params['update_id1'][$j])) {
                        $mtOrderReceiveStickyNote = MtOrderReceiveStickyNote::where('id', $params['update_id1'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtOrderReceiveStickyNote) &&
                            $mtOrderReceiveStickyNote['sticky_note_color'] === $params['update_color1'][$j] &&
                            $mtOrderReceiveStickyNote['sticky_note_name'] === $params['update_note_name1'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtOrderReceiveStickyNote->sticky_note_color = $params['update_color1'][$j];
                        $mtOrderReceiveStickyNote->sticky_note_name = $params['update_note_name1'][$j];
                        $mtOrderReceiveStickyNote->mt_user_last_update_id = Auth::user()->id;
                        $mtOrderReceiveStickyNote->save();
                    }
                    $j++;
                }
            } elseif ($params['def_sticky_note_kind_id'] === '2') {
                foreach ($params['update_id2'] as $param) {
                    if (!empty($params['update_id2'][$j])) {
                        $mtOrderReceiveStickyNote = MtOrderReceiveStickyNote::where('id', $params['update_id2'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtOrderReceiveStickyNote) &&
                            $mtOrderReceiveStickyNote['sticky_note_color'] === $params['update_color2'][$j] &&
                            $mtOrderReceiveStickyNote['sticky_note_name'] === $params['update_note_name2'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtOrderReceiveStickyNote->sticky_note_color = $params['update_color2'][$j];
                        $mtOrderReceiveStickyNote->sticky_note_name = $params['update_note_name2'][$j];
                        $mtOrderReceiveStickyNote->mt_user_last_update_id = Auth::user()->id;
                        $mtOrderReceiveStickyNote->save();
                    }
                    $j++;
                }
            } elseif ($params['def_sticky_note_kind_id'] === '3') {
                foreach ($params['update_id3'] as $param) {
                    if (!empty($params['update_id3'][$j])) {
                        $mtOrderReceiveStickyNote = MtOrderReceiveStickyNote::where('id', $params['update_id3'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtOrderReceiveStickyNote) &&
                            $mtOrderReceiveStickyNote['sticky_note_color'] === $params['update_color3'][$j] &&
                            $mtOrderReceiveStickyNote['sticky_note_name'] === $params['update_note_name3'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtOrderReceiveStickyNote->sticky_note_color = $params['update_color3'][$j];
                        $mtOrderReceiveStickyNote->sticky_note_name = $params['update_note_name3'][$j];
                        $mtOrderReceiveStickyNote->mt_user_last_update_id = Auth::user()->id;
                        $mtOrderReceiveStickyNote->save();
                    }
                    $j++;
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 受付付箋情報 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params) {
        //検索無しの為
        $result = MtOrderReceiveStickyNote::get();
        return $result;
    }


    /**
     * 受付付箋マスタ 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
    	/*
        $result = MtRoot::where('root_cd', $code)->first();
        return $result;
        */
    }


}
