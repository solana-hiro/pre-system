<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtStock extends Model
{
    use HasFactory;

    /**
     * 在庫マスタ
     * @var string
     */
    protected $table = 'mt_stocks';

    /**
     * @return BelongsTo
     */
    public function mtWarehouse()
    {
        return $this->belongsTo(MtWarehouse::class, 'mt_warehouse_id');
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
    public function defInOutKbn()
    {
        return $this->belongsTo(DefInOutKbn::class, 'id', 'mt_size_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUser()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_id');
    }

    /**
     * @return BelongsTo
     */
    public function trnOrderReceiveHeader()
    {
        return $this->belongsTo(TrnOrderReceiveHeader::class, 'id', 'trn_order_receive_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtWarehouseIssue()
    {
        return $this->belongsTo(MtWarehouse::class, 'id', 'mt_warehouse_issue_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtWarehousing()
    {
        return $this->belongsTo(MtWarehouse::class, 'id', 'mt_warehouse_warehousing_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
