<?php

namespace App\Services;

use App\Repositories\MtItemChangeHistory\MtItemChangeHistoryRepository;
use App\Http\Resources\MtItemChangeHistory\MtItemChangeHistoryListResource;
use Illuminate\Support\Facades\Log;

/**
 * 商品変更履歴関連 サービスクラス
 */
class MtItemChangeHistoryService
{

    /**
     * @var MtItemChangeHistoryRepository
     */
    private MtItemChangeHistoryRepository $mtItemChangeHistoryRepository;

    /**
     * @param MtItemChangeHistoryRepository $mtItemChangeHistoryRepository
     */
    public function __construct()
    {
        $this->mtItemChangeHistoryRepository = new MtItemChangeHistoryRepository();
    }

    /** 商品変更履歴  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtItemChangeHistoryRepository->getAll();
        return $datas;
    }

    /** 商品変更履歴  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtItemChangeHistoryRepository->export($params);
        $datas = MtItemChangeHistoryListResource::collection($result);
        return $datas;
    }

    /** 商品変更履歴  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtItemChangeHistoryRepository->get($params);
        return $datas;
    }

}
