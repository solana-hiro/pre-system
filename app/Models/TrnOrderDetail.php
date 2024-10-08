<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnOrderDetail extends Model
{
    use HasFactory;

    /**
     * 発注明細
     * @var string
     */
    protected $table = 'trn_order_details';

    /**
     * @return BelongsTo
     */
    public function trnOrderHeader()
    {
        // return $this->belongsTo(TrnOrderHeader::class, 'id', 'trn_order_header_id');
        return $this->belongsTo(TrnOrderHeader::class, 'trn_order_header_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItem()
    {
        // return $this->belongsTo(MtItem::class, 'id', 'mt_item_id');
        return $this->belongsTo(MtItem::class, 'mt_item_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
