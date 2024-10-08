<?php

namespace App\Services;

use App\Repositories\MtBillingAddress\MtBillingAddressRepository;
use Illuminate\Support\Facades\Log;

/**
 * 請求先関連 サービスクラス
 */
class MtBillingAddressService
{

    /**
     * @var mtBillingAddressRepository
     */
    private MtBillingAddressRepository $mtBillingAddressRepository;

    /**
     * @param MtBillingAddressRepository $mtBillingAddressRepository
     */
    public function __construct()
    {
        $this->mtBillingAddressRepository = new MtBillingAddressRepository();
    }

    /** 請求先 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtBillingAddressRepository->getAll();
        return $datas;
    }

    /** 請求先 件数取得
     *
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtBillingAddressRepository->get($params);
        return $datas;
    }

    /** 請求先 初期データ取得
     *
     * @return $rows
     */
    public function getInitData($id)
    {
        $datas = $this->mtBillingAddressRepository->getInitData($id);
        return $datas;
    }

    /** 請求先 初期データ取得(解除)
     *
     * @return $rows
     */
    public function getSequentiallyInitData($id)
    {
        $datas = $this->mtBillingAddressRepository->getSequentiallyInitData($id);
        return $datas;
    }

    /** 請求先 初期データ取得(解除)
     *
     * @return $rows
     */
    public function getClosingInitData($id)
    {
        $datas = $this->mtBillingAddressRepository->getClosingInitData($id);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtBillingAddressRepository->getByCode($params);
        return $datas;
    }
}
