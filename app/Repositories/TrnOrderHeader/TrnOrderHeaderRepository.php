<?php

namespace App\Repositories\TrnOrderHeader;

use App\Models\TrnOrderHeader;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class TrnOrderHeaderRepository implements TrnOrderHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = TrnOrderHeader::get();
        return $result;
    }

    /**
     * 発注伝票一括発行の情報取得
     * @param array $params
     * @return Object
     */
    public function getSlipIssue(array $params)
    {
        $result = TrnOrderHeader::get();
        return $result;
    }


    /**
     * 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $result = TrnOrderHeader::where('order_number', $code)->first();
        return $result;
    }

    /**
     * 発注チェックリストの情報取得
     * @param array $params
     * @return Object
     */
    public function getChecklist(array $params)
    {
        $result = TrnOrderHeader::get();
        return $result;
    }

    /**
     * 発注残一覧表(仕入先別納期別)の情報取得
     * @param array $params
     * @return Object
     */
    public function getOrderBalanceListSupplier(array $params)
    {
        $result = TrnOrderHeader::get();
        return $result;
    }

    /**
     * 発注残一覧表(商品別納期別)の情報取得
     * @param array $params
     * @return Object
     */
    public function getOrderBalanceListItem(array $params)
    {
        $result = TrnOrderHeader::get();
        return $result;
    }
}
