<?php

namespace App\Services;

use App\Repositories\MtWarehouse\MtWarehouseRepository;
use App\Http\Resources\MtWarehouse\MtWarehouseListResource;
use Illuminate\Support\Facades\Log;

/**
 * 倉庫マスタ関連 サービスクラス
 */
class MtWarehouseService
{

    /**
     * @var MtWarehouseRepository
     */
    private MtWarehouseRepository $mtWarehouseRepository;

    /**
     * @param MtWarehouseRepository $mtWarehouseRepository
     */
    public function __construct()
    {
        $this->mtWarehouseRepository = new MtWarehouseRepository();
    }

    /** 倉庫 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtWarehouseRepository->getAll();
        return $datas;
    }

    /** 倉庫マスタ 更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtWarehouseRepository->update($params);
        return $datas;
    }

    /** 倉庫マスタ 削除(id指定)
     * @param $params
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtWarehouseRepository->delete($id);
        return $datas;
    }

    /** 倉庫リスト  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtWarehouseRepository->export($params);
        $datas = MtWarehouseListResource::collection($result);
        return $datas;
    }

    /** 倉庫マスタ  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtWarehouseRepository->get($params);
        return $datas;
    }

    /** 倉庫マスタ  初期データ取得
     * @param $params
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtWarehouseRepository->getInitData();
        return $datas;
    }

    /** 倉庫マスタ  データの存在(code指定)
     * @param $code
     * @return $rows
     */
    public function isExist($code)
    {
        $datas = $this->mtWarehouseRepository->isExist($code);
        return $datas;
    }

    /** 倉庫マスタ  自動補完
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtWarehouseRepository->getByCode($params);
        return $datas;
    }
    /** 最小ID取得
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->mtWarehouseRepository->getMinId();
        return $datas;
    }

    /** 最大ID取得
     * @return $rows
     */
    public function getMaxID()
    {
        $datas = $this->mtWarehouseRepository->getMaxId();
        return $datas;
    }

    /** 前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->mtWarehouseRepository->getPrevById($id);
        return $datas;
    }

    /** 次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->mtWarehouseRepository->getNextById($id);
        return $datas;
    }
}
