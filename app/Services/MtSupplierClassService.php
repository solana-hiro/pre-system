<?php

namespace App\Services;

use App\Repositories\MtSupplierClass\MtSupplierClassRepository;
use App\Http\Resources\MtSupplierClass\MtSupplierClassListResource;
use Illuminate\Support\Facades\Log;

/**
 * 仕入先分類マスタ関連 サービスクラス
 */
class MtSupplierClassService
{

    /**
     * @var MtSupplierClassRepository
     */
    private MtSupplierClassRepository $MtSupplierClassRepository;

    /**
     * @param MtSupplierClassRepository $MtSupplierClassRepository
     */
    public function __construct()
    {
        $this->MtSupplierClassRepository = new MtSupplierClassRepository();
    }

    /** 仕入先分類  全件取得
     *
     * @return $rows
     */
    public function get()
    {
        $datas = $this->MtSupplierClassRepository->getAll();
        return $datas;
    }

    /** 仕入先分類  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->MtSupplierClassRepository->getInitData();
        return $datas;
    }

    /** 仕入先分類1  全件取得
     *
     * @return $rows
     */
    public function getAllClass1()
    {
        $datas = $this->MtSupplierClassRepository->getAllClass1();
        return $datas;
    }

    /** 仕入先分類2  全件取得
     *
     * @return $rows
     */
    public function getAllClass2()
    {
        $datas = $this->MtSupplierClassRepository->getAllClass2();
        return $datas;
    }

    /** 仕入先分類3  全件取得
     *
     * @return $rows
     */
    public function getAllClass3()
    {
        $datas = $this->MtSupplierClassRepository->getAllClass3();
        return $datas;
    }

    /** 仕入先分類1  条件取得
     * @param $params
     * @return $rows
     */
    public function getClass1($params)
    {
        $datas = $this->MtSupplierClassRepository->getClass1($params);
        return $datas;
    }

    /** 仕入先分類2  条件取得
     * @param $params
     * @return $rows
     */
    public function getClass2($params)
    {
        $datas = $this->MtSupplierClassRepository->getClass2($params);
        return $datas;
    }

    /** 仕入先分類3  条件取得
     * @param $params
     * @return $rows
     */
    public function getClass3($params)
    {
        $datas = $this->MtSupplierClassRepository->getClass3($params);
        return $datas;
    }

    /** 仕入先分類  更新
     *
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->MtSupplierClassRepository->update($params);
        return $datas;
    }

    /** 仕入先分類  削除
     *
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->MtSupplierClassRepository->delete($id);
        return $datas;
    }

    /** 仕入先分類  ファイル出力
     *
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->MtSupplierClassRepository->export($params);
        $datas = MtSupplierClassListResource::collection($result);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code, $def_supplier_class_thing_id
     * @return $rows
     */
    public function codeAutoComplete($code, $def_supplier_class_thing_id)
    {
        $datas = $this->MtSupplierClassRepository->getByCode($code, $def_supplier_class_thing_id);
        return $datas;
    }

}
