<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnOrderReceiveDetail extends Model
{
    use HasFactory;

    protected $fillable = [
      'trn_order_receive_header_id',
      'order_line_no',
      'order_receive_detail_cd',
      'mt_item_id',
      'item_name',
      'retail_price',
      'order_receive_quantity',
      'unit',
      'price_rate',
      'cost_price',
      'order_receive_price',
      'cost_amount',
      'order_receive_amount',
      'specify_deadline_none_flg',
      'specify_deadline',
      'memo_1',
      'memo_2',
      'order_receive_finish_flg',
      'shortage_flg',
      'remaining_flg',
      'payment_finish_flg',
      'mt_user_last_update_id',
      'mt_order_receive_sticky_note_id',
      'item_name_input_kbn',
      'def_shipping_status_kbn_id'
    ];

    /**
     * 受注明細
     * @var string
     */
    protected $table = 'trn_order_receive_details';

    /**
     * @return BelongsTo
     */
    public function trnOrderReceiveHeader()
    {
        return $this->belongsTo(TrnOrderReceiveHeader::class, 'id', 'trn_order_receive_header_id');
    }

    /**
     * @return HasOne
     */
    public function trnSaleDetail()
    {
        return $this->hasOne(TrnSaleDetail::class, 'trn_order_receive_detail_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItem()
    {
        return $this->belongsTo(MtItem::class, 'id', 'mt_item_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtOrderReceiveStickyNote()
    {
        return $this->belongsTo(MtOrderReceiveStickyNote::class, 'id', 'mt_order_receive_sticky_note_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    /**
     * IDによるCode取得
     * @param $id
     * @return $model
     */
    static public function getCodeById($id)
    {
        return self::query()->select('order_receive_detail_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('order_receive_detail_cd', $code)->first();
    }

}
