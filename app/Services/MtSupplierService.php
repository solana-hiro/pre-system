<?php

namespace App\Services;

use App\Repositories\MtSupplier\MtSupplierRepository;
use App\Http\Resources\MtSupplier\MtSupplierListResource;
use Illuminate\Support\Facades\Log;

/**
 * 仕入先マスタ関連 サービスクラス
 */
class MtSupplierService
{

    /**
     * @var MtSupplierRepository
     */
    private MtSupplierRepository $mtSupplierRepository;

    /**
     * @param MtSupplierRepository $mtSupplierRepository
     */
    public function __construct()
    {
        $this->mtSupplierRepository = new MtSupplierRepository();
    }

    /** 仕入先  全件取得
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtSupplierRepository->getAll();
        return $datas;
    }

    /** 仕入先  条件取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtSupplierRepository->get($params);
        return $datas;
    }

    public function getById($params)
    {
        $id = $params['id'];
        $data = $this->mtSupplierRepository->getById($id);
        return $data;
    }

    /** 仕入先  条件取得
     * @param $id
     * @return $rows
     */
    public function getDetailById($id)
    {
        $datas = $this->mtSupplierRepository->getDetailById($id);
        return $datas;
    }

    /** 仕入先  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtSupplierRepository->update($params);
        return $datas;
    }

    /** 仕入先(詳細)  削除
     * @param $delete
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtSupplierRepository->delete($id);
        return $datas;
    }

    /** 仕入先  ファイル出力
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $datas = $this->mtSupplierRepository->export($params);
        $result = MtSupplierListResource::collection($datas);
        return $result;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtSupplierRepository->getByCode($params);
        return $datas;
    }

    /** 仕入先  最小ID取得
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->mtSupplierRepository->getMinId();
        return $datas;
    }

    /** 仕入先  最大ID取得
     * @return $rows
     */
    public function getMaxID()
    {
        $datas = $this->mtSupplierRepository->getMaxId();
        return $datas;
    }

    /** 仕入先  前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->mtSupplierRepository->getPrevById($id);
        return $datas;
    }

    /** 仕入先  次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->mtSupplierRepository->getNextById($id);
        return $datas;
    }
}
