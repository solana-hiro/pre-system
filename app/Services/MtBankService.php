<?php

namespace App\Services;

use App\Repositories\MtBank\MtBankRepository;
use App\Http\Resources\MtBank\MtBankListResource;
use Illuminate\Support\Facades\Log;

/**
 * 銀行関連 サービスクラス
 */
class MtBankService
{

    /**
     * @var mtBankRepository
     */
    private MtBankRepository $mtBankRepository;

    /**
     * @param MtBankRepository $mtBankRepository
     */
    public function __construct()
    {
        $this->mtBankRepository = new MtBankRepository();
    }

    /** 銀行 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtBankRepository->getAll();
        return $datas;
    }

    /** 銀行 初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtBankRepository->getInitData();
        return $datas;
    }

    /** 銀行 削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtBankRepository->delete($id);
        return $datas;
    }

    /** 銀行マスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtBankRepository->update($params);
        return $datas;
    }

    /** 銀行リスト(一覧)  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtBankRepository->export($params);
        $datas = MtBankListResource::collection($result);
        return $datas;
    }

    /** 銀行 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtBankRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtBankRepository->getByCode($params);
        return $datas;
    }
}
