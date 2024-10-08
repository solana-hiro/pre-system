<?php

namespace App\Services;

use App\Repositories\TrnPayHeader\TrnPayHeaderRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * 支払ヘッダ関連 サービスクラス
 */
class TrnPayHeaderService
{

    /**
     * @var TrnPayHeaderRepository
     */
    private TrnPayHeaderRepository $trnPayHeaderRepository;

    /**
     * @param TrnPayHeaderRepository $trnPayHeaderRepository
     */
    public function __construct(TrnPayHeaderRepository $trnPayHeaderRepository)
    {
        $this->trnPayHeaderRepository = $trnPayHeaderRepository;
    }

    /** 支払ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnPayHeaderRepository->getAll();

        return $datas;
    }

    /** 支払時消費税一括計算 更新
     *
     * @return $rows
     */
    public function updateTaxCalculate($params)
    {
        $datas = $this->trnPayHeaderRepository->updateTaxCalculate($params);
        return $datas;
    }

    /** 支払データ確定処理　削除
     *
     * @return $rows
     */
    public function deleteDataDecision($params)
    {
        $datas = $this->trnPayHeaderRepository->deleteDataDecision($params);
        return $datas;
    }

    /** 支払データ確定処理　更新
     *
     * @return $rows
     */
    public function updateDataDecision($params)
    {
        $datas = $this->trnPayHeaderRepository->updateDataDecision($params);
        return $datas;
    }

    /** 支払一覧表の情報取得(Pdf)
     *
     * @return $rows
     */
    public function getPdfPaymentList($params)
    {
        $datas = $this->trnPayHeaderRepository->getPaymentList($params);
        return $datas;
    }

    /** 支払一覧表の情報取得(Excel)
     *
     * @return $rows
     */
    public function getExcelPaymentList($params)
    {
        $datas = $this->trnPayHeaderRepository->getPaymentList($params);
        return $datas;
    }

    /** 支払明細書の情報取得(Excel)
     *
     * @return $rows
     */
    public function getPaymentIssue($params)
    {
        $datas = $this->trnPayHeaderRepository->getPaymentIssue($params);
        return $datas;
    }

    /** 買掛残高一覧表の情報取得(Excel)
     *
     * @return $rows
     */
    public function getList($params)
    {
        $datas = $this->trnPayHeaderRepository->getList($params);
        return $datas;
    }

    /** 仕入先元帳の情報取得(プレビュー表示)
     *
     * @return $rows
     */
    public function getPreviewSupplierLedger($params)
    {
        $datas = $this->trnPayHeaderRepository->getSupplierLedger($params);
        return $datas;
    }

    /** 仕入先元帳の情報取得(PDF)
     *
     * @return $rows
     */
    public function getPdfSupplierLedger($params)
    {
        $datas = $this->trnPayHeaderRepository->getSupplierLedger($params);
        return $datas;
    }

    /** 仕入先元帳の情報取得(Excel)
     *
     * @return $rows
     */
    public function getExcelSupplierLedger($params)
    {
        $datas = $this->trnPayHeaderRepository->getSupplierLedger($params);
        return $datas;
    }

    public function getPaginatedData($page, $perPage)
    {
        // Assuming you have a method to get all data
        $allData = $this->getAll();

        // If $allData is already a Collection, use it directly
        // Otherwise, convert it to a Collection
        $collection = $allData instanceof Collection ? $allData : Collection::make($allData);

        // Create a LengthAwarePaginator instance
        $paginatedData = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $paginatedData;
    }

}
