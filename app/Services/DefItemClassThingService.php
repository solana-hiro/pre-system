<?php

namespace App\Services;

use App\Repositories\DefItemClassThing\DefItemClassThingRepository;
use Illuminate\Support\Facades\Log;

/**
 * 商品分類項目定義関連 サービスクラス
 */
class DefItemClassThingService
{

    /**
     * @var DefItemClassThingRepository
     */
    private DefItemClassThingRepository $defItemClassThingRepository;

    /**
     * @param DefItemClassThingRepository $defItemClassThingRepository
     */
    public function __construct()
    {
        $this->defItemClassThingRepository = new DefItemClassThingRepository();
    }

    /** 商品分類項目定義  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defItemClassThingRepository->getAll();
        return $datas;
    }

    /** 商品分類項目定義  ID指定
     *
     * @return $rows
     */
    public function getById($id)
    {
        $datas = $this->defItemClassThingRepository->getById($id);
        return $datas;
    }
}
