<?php

namespace App\Services;

use App\Repositories\TrnOrderDetail\TrnOrderDetailRepository;
use Illuminate\Support\Facades\Log;

/**
 * 発注明細関連 サービスクラス
 */
class TrnOrderDetailService
{

    /**
     * @var trnOrderDetailRepository
     */
    private TrnOrderDetailRepository $trnOrderDetailRepository;

    /**
     * @param TrnOrderDetailRepository $trnOrderDetailRepository
     */
    public function __construct()
    {
        $this->trnOrderDetailRepository = new TrnOrderDetailRepository();
    }

    public function getAll()
    {
        $datas = $this->trnOrderDetailRepository->getAll();
        return $datas;
    }

    public function get($params)
    {
        $datas = $this->trnOrderDetailRepository->get($params);
        return $datas;
    }


}
