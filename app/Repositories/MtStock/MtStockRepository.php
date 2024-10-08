<?php

namespace App\Repositories\MtStock;

use App\Models\MtStock;
use App\Models\MtColor;
use App\Models\MtSize;
use App\Models\MtItem;
use App\Consts\CommonConsts;
use App\Models\MtLocation;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtStockRepository implements MtStockRepositoryInterface
{
    public function getStocks($warehouse_id, $mt_stock_keeping_unit_ids)
    {
        $result = MtStock::where('mt_warehouse_id', $warehouse_id)
            ->whereIn('mt_stock_keeping_unit_id', $mt_stock_keeping_unit_ids)
            ->get();
        return $result;
    }

    public function getStocksByKeepingUnitId($mt_stock_keeping_unit_id)
    {
        $result = MtStock::where('mt_stock_keeping_unit_id', $mt_stock_keeping_unit_id)
            ->with('mtWarehouse')
            ->get();
        return $result;
    }
}
