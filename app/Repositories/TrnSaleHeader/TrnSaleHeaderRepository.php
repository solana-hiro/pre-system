<?php
namespace App\Repositories\TrnSaleHeader;

use App\Models\TrnSaleHeader;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class TrnSaleHeaderRepository implements TrnSaleHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnSaleHeader::get();
		return $result;
    }

    /**
     * 売上確定の情報取得
     * @param array $params
     * @return Object
     */
     public function getSaleDecision($params) {
     	$result = TrnSaleHeader::get();
        return $result;
     }

    /**
     * 売上確定の更新
     * @param array $params
     * @return Object
     */
     public function updateSaleDecision($params) {
     	$result = TrnSaleHeader::get();
     	// DB更新
        return $result;
     }

    /**
     * 売上確定の一括反映
     * @param array $params
     * @return Object
     */
     public function executeSaleDecision($params) {
     	$result = TrnSaleHeader::get();
     	// DB更新
        return $result;
     }

    /**
     * 売上チェックリストの情報取得
     * @param array $params
     * @return Object
     */
     public function exportChecklist($params) {
     	$result = TrnSaleHeader::get();
        return $result;
     }

    /**
     * 売上伝票一括発行の情報取得
     * @param array $params
     * @return Object
     */
     public function exportSliplist($params) {
     	$result = TrnSaleHeader::get();
        return $result;
     }

    /**
     * 売上データの更新
     * @param array $params
     * @return Object
     */
     public function updateSalesDataImport($params) {
     	$result = TrnSaleHeader::get();
        return $result;
     }

    /**
     * 売上データの情報取得
     * @param array $params
     * @return Object
     */
     public function getSalesDataImport($params) {
     	$result = TrnSaleHeader::get();
        return $result;
     }

}
