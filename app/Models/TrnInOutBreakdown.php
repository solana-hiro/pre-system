<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnInOutBreakdown extends Model
{
    use HasFactory;

    /**
     * 入出庫内訳
     * @var string
     */
    protected $table = 'trn_in_out_breakdowns';

    /**
     * 追加コラム
     * @var array
     */
    protected $fillable = [
        'id',
        'trn_in_out_detail_id',
        'mt_stock_keeping_unit_id',
        'order_in_out_quantity',
        'mt_user_last_update_id',
    ];

    /**
     * @return BelongsTo
     */
    public function trnInOutDetail()
    {
        return $this->belongsTo(TrnInOutDetail::class, 'id', 'trn_in_out_detail_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtStockKeepingUnit()
    {
        return $this->belongsTo(MtStockKeepingUnit::class, 'mt_stock_keeping_unit_id');
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
        return self::query()->select('trn_in_out_detail_id')->where('id', $id)->first();
    }

    /**
     * 明細IDによるID取得
     * @param $detailId
     * @return $model
     */
    static public function getIdByDetailId($detailId)
    {
        return self::query()->select('id')->where('trn_in_out_detail_id', $detailId)->first();
    }

}
