<?php

namespace App\Services;

use App\Repositories\MtRoot\MtRootRepository;
//use App\Http\Resources\MtRoot\MtRootListResource;
use Illuminate\Support\Facades\Log;

/**
 * ルートマスタ関連 サービスクラス
 */
class MtRootService
{

    /**
     * @var MtRootRepository
     */
    private MtRootRepository $mtRootRepository;

    /**
     * @param MtRootRepository $mtRootRepository
     */
    public function __construct()
    {
        $this->mtRootRepository = new MtRootRepository();
    }

    /** ルートマスタ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtRootRepository->getAll();
        return $datas;
    }

    /** ルートマスタ  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtRootRepository->getInitData();
        return $datas;
    }

    /** ルートマスタ  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtRootRepository->delete($id);
        return $datas;
    }

    /** ルートマスタ   更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtRootRepository->update($params);
        return $datas;
    }

    /** ルートマスタ  指定条件にて取得
     * @param $params
     * @return $result
     */
    public function get($params)
    {
        $datas = $this->mtRootRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtRootRepository->getByCode($params);
        return $datas;
    }
}
