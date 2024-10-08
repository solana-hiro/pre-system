<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnSaleBreakdown extends Model
{
    use HasFactory;

    /**
     * 売上内訳
     * @var string
     */
    protected $table = 'trn_sale_breakdowns';

    /**
     * @return BelongsTo
     */
    public function trnSaleDetail()
    {
        return $this->belongsTo(TrnSaleDetail::class, 'id', 'trn_sale_detail_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtStockKeepingUnit()
    {
        return $this->belongsTo(MtStockKeepingUnit::class, 'id', 'mt_stock_keeping_unit_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    /**
     * IDによる明細ID取得
     * @param $id
     * @return $model
     */
    static public function getDetailIdById($id)
    {
        return self::query()->select('trn_sale_detail_id')->where('id', $id)->first();
    }

    /**
     * 明細IDによるID取得
     * @param $detailId
     * @return $model
     */
    static public function getIdByDetailId($detailId)
    {
        return self::query()->select('id')->where('trn_sale_detail_id', $detailId)->first();
    }

}
