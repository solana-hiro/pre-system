<?php

namespace App\Services;

use App\Repositories\DefTaxRateKbn\DefTaxRateKbnRepository;
use Illuminate\Support\Facades\Log;

/**
 * 税率区分関連 サービスクラス
 */
class DefTaxRateKbnService
{

    /**
     * @var DefTaxRateKbnRepository
     */
    private DefTaxRateKbnRepository $defTaxRateKbnRepository;

    /**
     * @param DefTaxRateKbnRepository $defTaxRateKbnRepository
     */
    public function __construct()
    {
        $this->defTaxRateKbnRepository = new DefTaxRateKbnRepository();
    }

    /** 税率区分  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defTaxRateKbnRepository->getAll();
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->defTaxRateKbnRepository->getByCode($code);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoCompleteWithRate($code)
    {
        $datas = $this->defTaxRateKbnRepository->getByCodeWithRate($code);
        return $datas;
    }
}
