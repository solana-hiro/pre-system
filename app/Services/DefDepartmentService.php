<?php

namespace App\Services;

use App\Repositories\DefDepartment\DefDepartmentRepository;
use Illuminate\Support\Facades\Log;

/**
 * 部門定義関連 サービスクラス
 */
class DefDepartmentService
{

    /**
     * @var defDepartmentRepository
     */
    private DefDepartmentRepository $defDepartmentRepository;

    /**
     * @param DefDepartmentRepository $defDepartmentRepository
     */
    public function __construct()
    {
        $this->defDepartmentRepository = new DefDepartmentRepository();
    }

    /** 部門定義 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defDepartmentRepository->getAll();
        return $datas;
    }

    /** 部門定義 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->defDepartmentRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->defDepartmentRepository->getByCode($params);
        return $datas;
    }
}
