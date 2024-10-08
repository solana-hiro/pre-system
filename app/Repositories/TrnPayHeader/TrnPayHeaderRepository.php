<?php
namespace App\Repositories\TrnPayHeader;

use App\Models\TrnPayHeader;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class TrnPayHeaderRepository implements TrnPayHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnPayHeader::get();
		return $result;
    }

    /**
     * 支払時消費税一括計算  更新
     * @param array $params
     * @return Object
     */
     public function updateTaxCalculate(array $params) {
     	$result = TrnPayHeader::get();
        return $result;
     }

    /**
     * 支払データ確定処理  削除
     * @param array $params
     * @return Object
     */
     public function deleteDataDecision(array $params) {
     	$result = TrnPayHeader::get();
        return $result;
     }

    /**
     * 支払データ確定処理  更新
     * @param array $params
     * @return Object
     */
     public function updateDataDecision(array $params) {
     	$result = TrnPayHeader::get();
        return $result;
     }

    /**
     * 支払一覧表の情報取得
     * @param array $params
     * @return Object
     */
     public function getPaymentList(array $params) {
     	$result = TrnPayHeader::get();
        return $result;
     }

    /**
     * 支払明細書の情報取得
     * @param array $params
     * @return Object
     */
     public function getPaymentIssue(array $params) {
     	$result = TrnPayHeader::get();
        return $result;
     }

    /**
     * 買掛残高一覧表の情報取得
     * @param array $params
     * @return Object
     */
     public function getList(array $params) {
     	$result = TrnPayHeader::get();
        return $result;
     }

    /**
     * 仕入先元帳の情報取得
     * @param array $params
     * @return Object
     */
     public function getSupplierLedger(array $params) {
     	$result = TrnPayHeader::get();
        return $result;
     }

}
