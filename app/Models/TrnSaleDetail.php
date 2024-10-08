<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnSaleDetail extends Model
{
    use HasFactory;

    /**
     * 売上明細
     * @var string
     */
    protected $table = 'trn_sale_details';

    /**
     * @return BelongsTo
     */
    public function trnSaleHeader()
    {
        return $this->belongsTo(TrnSaleHeader::class, 'id', 'trn_sale_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function trnOrderReceiveDetail()
    {
        return $this->belongsTo(TrnOrderReceiveDetail::class, 'id', 'trn_order_receive_detail_id');
    }

    /**
     * @return BelongsTo
     */
    public function defSaleKbn()
    {
        return $this->belongsTo(DefSaleKbn::class, 'id', 'def_sale_kbn_id');
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
        return self::query()->select('sale_detail_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('sale_detail_cd', $code)->first();
    }

}
