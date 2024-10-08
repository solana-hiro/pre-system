<?php

namespace App\Services;

use App\Repositories\MtOrderReceiveStickyNote\MtOrderReceiveStickyNoteRepository;
use Illuminate\Support\Facades\Log;

/**
 * 受付付箋マスタ関連 サービスクラス
 */
class MtOrderReceiveStickyNoteService
{

    /**
     * @var MtOrderReceiveStickyNoteRepository
     */
    private MtOrderReceiveStickyNoteRepository $mtOrderReceiveStickyNoteRepository;

    /**
     * @param MtOrderReceiveStickyNoteRepository $mtOrderReceiveStickyNoteRepository
     */
    public function __construct()
    {
        $this->mtOrderReceiveStickyNoteRepository = new MtOrderReceiveStickyNoteRepository();
    }

    /** 受付付箋マスタ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtOrderReceiveStickyNoteRepository->getAll();
        return $datas;
    }

    /** 受付付箋マスタ  全件取得
     *
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtOrderReceiveStickyNoteRepository->get($params);
        return $datas;
    }

    /** 受付付箋  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtOrderReceiveStickyNoteRepository->getInitData();
        return $datas;
    }

    /** 受付付箋   更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtOrderReceiveStickyNoteRepository->update($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    /*
    public function codeAutoComplete($code)
    {
        $datas = $this->mtOrderReceiveStickyNoteRepository->getByCode($code);
        return $datas;
    }
    */

    public function getStickyNotesForReceiveOrder() {
        $stickyNotes = $this->mtOrderReceiveStickyNoteRepository->getStickyNotesForReceiveOrder();
        return $stickyNotes;
    }
}
