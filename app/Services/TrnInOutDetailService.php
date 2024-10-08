<?php

namespace App\Services;

use App\Repositories\TrnInOutDetail\TrnInOutDetailRepository;

/**
 * 入出庫ヘッダ関連 サービスクラス
 */
class TrnInOutDetailService
{

    /**
     * @var TrnInOutDetailRepository
     */
    private TrnInOutDetailRepository $repository;

    /**
     * @param TrnInOutDetailRepository $repository
     */
    public function __construct()
    {
        $this->repository = new TrnInOutDetailRepository();
    }

    /** 入出庫明細データの更新
     * @param $params, $trn_in_out_header_id
     * @return Object
     */

    public function updateInOutData($params, $trn_in_out_header_id ,$key)
    {
        $data = $this->repository->updateInOutData($params, $trn_in_out_header_id, $key);
        return $data;
        
    }

    /** 入出庫明細データの削除
     * @param $deleteInOutData
     * @return Boolean
     */
    public function deleteInOutData($trn_in_out_detail_id)
    {
        $data = $this->repository->deleteInOutData($trn_in_out_detail_id);
        return $data;
    }
}
