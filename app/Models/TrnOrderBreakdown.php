<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnOrderBreakdown extends Model
{
    use HasFactory;

    /**
     * 発注内訳
     * @var string
     */
    protected $table = 'trn_order_breakdowns';

    /**
     * @return BelongsTo
     */
    public function trnOrderDetail()
    {
        return $this->belongsTo(TrnOrderDetail::class, 'id', 'trn_order_detail_id');
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
}
