<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnShippingInspectionHeader extends Model
{
    use HasFactory;

    /**
     * 出荷検品ヘッダ
     * @var string
     */
    protected $table = 'trn_shipping_inspection_headers';

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
    public function mtUserPickingManager()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_picking_manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastPickingManager()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_picking_manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserPickingSummarizeManager()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_picking_summarize_manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserInspectionManager()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_inspection_manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
