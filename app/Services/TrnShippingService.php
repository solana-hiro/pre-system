<?php

namespace App\Services;

use App\Repositories\TrnShipping\TrnShippingRepository;
use Illuminate\Support\Facades\Log;

/**
 * 出荷情報関連 サービスクラス
 */
class TrnShippingService
{

    /**
     * @var trnShippingRepository
     */
    private TrnShippingRepository $trnShippingRepository;

    /**
     * @param TrnShippingRepository $trnShippingRepository
     */
    public function __construct()
    {
        $this->trnShippingRepository = new TrnShippingRepository();
    }

    /** 出荷情報関連  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnShippingRepository->getAll();
        return $datas;
    }

    /** 出荷指示の情報取得
     *
     * @return $rows
     */
    public function getShippingInstructionOutput($params)
    {
        $datas = $this->trnShippingRepository->getShippingInstructionOutput($params);
        return $datas;
    }

    /** 出荷指示の情報更新
     *
     * @return $rows
     */
    public function updateShippingInstructionImport($params)
    {
        $datas = $this->trnShippingRepository->updateShippingInstructionOutput($params);
        return $datas;
    }

}
?>
