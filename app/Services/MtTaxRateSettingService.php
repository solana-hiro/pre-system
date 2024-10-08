<?php

namespace App\Services;

use App\Repositories\MtTaxRateSetting\MtTaxRateSettingRepository;
use Illuminate\Support\Facades\Log;

/**
 * 税率設定マスタ関連 サービスクラス
 */
class MtTaxRateSettingService
{

    /**
     * @var MtTaxRateSettingRepository
     */
    private MtTaxRateSettingRepository $mtTaxRateSettingRepository;

    /**
     * @param MtTaxRateSettingRepository $mtTaxRateSettingRepository
     */
    public function __construct()
    {
        $this->mtTaxRateSettingRepository = new MtTaxRateSettingRepository();
    }

    /** 税率設定マスタ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtTaxRateSettingRepository->getAll();
        return $datas;
    }

    /** 税率設定マスタ  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtTaxRateSettingRepository->getInitData();
        return $datas;
    }

    /** 税率設定マスタ  初期データ取得(code指定)
     *
     * @return $rows
     */
    public function getInitDataById($code)
    {
        $datas = $this->mtTaxRateSettingRepository->getInitDataById($code);
        return $datas;
    }

    /** 税率設定マスタ  定義取得
     *
     * @return $rows
     */
    public function getDefTaxRateKbns()
    {
        $datas = $this->mtTaxRateSettingRepository->getDefTaxRateKbns();
        return $datas;
    }

    /** 税率設定マスタ  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtTaxRateSettingRepository->delete($id);
        return $datas;
    }

    /** 税率設定マスタ   更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtTaxRateSettingRepository->update($params);
        return $datas;
    }

    /** 税率設定マスタ  指定条件にて取得
     * @param $params
     * @return $result
     */
    public function get($params)
    {
        $datas = $this->mtTaxRateSettingRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->mtTaxRateSettingRepository->getByCode($code);
        return $datas;
    }
}
