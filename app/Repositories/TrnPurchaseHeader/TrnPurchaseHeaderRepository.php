<?php
namespace App\Repositories\TrnPurchaseHeader;

use App\Models\TrnPurchaseHeader;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class TrnPurchaseHeaderRepository implements TrnPurchaseHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnPurchaseHeader::get();
		return $result;
    }

    /**
     * 発注チェックリストの情報取得
     * @param array $params
     * @return Object
     */
     public function getChecklist(array $params) {
     	$result = TrnPurchaseHeader::get();
        return $result;
     }

    /**
     * 商品仕入日計表の情報取得
     * @param array $params
     * @return Object
     */
     public function getItemDailyList(array $params) {
     	$result = TrnPurchaseHeader::get();
        return $result;
     }

}
