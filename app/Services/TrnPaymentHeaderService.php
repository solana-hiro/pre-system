<?php

namespace App\Services;

use App\Repositories\TrnPaymentHeader\TrnPaymentHeaderRepository;
use Illuminate\Support\Facades\Log;

/**
 * 入金ヘッダ関連 サービスクラス
 */
class TrnPaymentHeaderService
{

    /**
     * @var trnPaymentHeaderRepository
     */
    private TrnPaymentHeaderRepository $trnPaymentHeaderRepository;

    /**
     * @param TrnPaymentHeaderRepository $trnPaymentHeaderRepository
     */
    public function __construct()
    {
        $this->trnPaymentHeaderRepository = new TrnPaymentHeaderRepository();
    }

    /** 入金ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnPaymentHeaderRepository->getAll();
        return $datas;
    }

    /** 入金チェックリストの情報取得(Excel)
     *
     * @return $rows
     */
    public function exportCheckList($params)
    {
        $datas = $this->trnPaymentHeaderRepository->exportCheckList($params);
        return $datas;
    }

    /** 受取手形一覧表の情報取得(プレビュー表示)
     *
     * @return $rows
     */
    public function exportBillReceipt($params)
    {
        $datas = $this->trnPaymentHeaderRepository->exportBillReceipt($params);
        return $datas;
    }

    /** 受取手形一覧表の情報取得(PDF)
     *
     * @return $rows
     */
    public function exportPdfBillReceipt($params)
    {
        $datas = $this->trnPaymentHeaderRepository->exportBillReceipt($params);
        // PDF出力
        return $datas;
    }

    /** 受取手形一覧表の情報取得(Excel)
     *
     * @return $rows
     */
    public function exportExcelBillReceipt($params)
    {
        $datas = $this->trnPaymentHeaderRepository->exportBillReceipt($params);
        return $datas;
    }

    /** 売掛残高一覧表の情報取得(Excel)
     *
     * @return $rows
     */
    public function exportList($params)
    {
        $datas = $this->trnPaymentHeaderRepository->exportList($params);
        return $datas;
    }

    /** 得意先元帳の情報取得(Excel)
     *
     * @return $rows
     */
    public function exportCustomerLedger($params)
    {
        $datas = $this->trnPaymentHeaderRepository->exportCustomerLedger($params);
        return $datas;
    }

    /** 未回収残一覧表の情報取得(Excel)
     *
     * @return $rows
     */
    public function exportCollectBalanceList($params)
    {
        $datas = $this->trnPaymentHeaderRepository->exportCollectBalanceList($params);
        return $datas;
    }

}
