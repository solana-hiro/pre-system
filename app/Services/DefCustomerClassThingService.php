<?php

namespace App\Services;

use App\Repositories\DefCustomerClassThing\DefCustomerClassThingRepository;
use Illuminate\Support\Facades\Log;

/**
 * 得意先分類項目定義関連 サービスクラス
 */
class DefCustomerClassThingService
{

    /**
     * @var defCustomerClassThingRepository
     */
    private DefCustomerClassThingRepository $defCustomerClassThingRepository;

    /**
     * @param DefCustomerClassThingRepository $defCustomerClassThingRepository
     */
    public function __construct()
    {
        $this->defCustomerClassThingRepository = new DefCustomerClassThingRepository();
    }

    /** 得意先分類項目定義  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defCustomerClassThingRepository->getAll();
        return $datas;
    }

}
