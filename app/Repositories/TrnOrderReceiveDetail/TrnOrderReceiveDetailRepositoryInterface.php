<?php
namespace App\Repositories\TrnOrderReceiveDetail;

interface TrnOrderReceiveDetailRepositoryInterface
{
    /* 入金案内書出力 */
    public function exportPaymentGuidanceExcel(array $params);
}
