<?php

namespace App\Services;

use App\Repositories\MtStock\MtStockRepository;
use App\Repositories\MtWarehouse\MtWarehouseRepository;
use App\Repositories\MtStockKeepingUnit\MtStockKeepingUnitRepository;
use App\Http\Resources\MtSize\MtSizeListResource;
use Illuminate\Support\Facades\Log;

/**
 * 在庫マスタ サービスクラス
 */
class MtStockService
{

    /**
     * @var MtStockRepository
     */
    private MtStockRepository $mtStockRepository;

    /**
     * @var MtWarehouseRepository
     */
    private MtWarehouseRepository $mtWarehouseRepository;

    /**
     * @param MtStockRepository $mtStockRepository
     * @param MtWarehouseRepository $mtWarehouseRepository
     */
    public function __construct()
    {
        $this->mtStockRepository = new MtStockRepository();
        $this->mtWarehouseRepository = new MtWarehouseRepository();
    }

    public function getStocks($warehouse_cd, $mt_stock_keeping_units)
    {
        // $mt_stock_keeping_units(collection)からidを配列として取得
        $mt_stock_keeping_unit_ids = $mt_stock_keeping_units->pluck('id')->toArray();
        $ware_house = $this->mtWarehouseRepository->getByCode([
            'warehouse_cd' => $warehouse_cd
        ]);

        $datas = $this->mtStockRepository->getStocks($ware_house->id, $mt_stock_keeping_unit_ids);
        return $datas;
    }

    public function getStocksByKeepingUnitId($mt_stock_keeping_unit_id)
    {
        $datas = $this->mtStockRepository->getStocksByKeepingUnitId($mt_stock_keeping_unit_id);
        return $datas;
    }
}
