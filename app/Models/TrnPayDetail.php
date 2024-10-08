<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnPayDetail extends Model
{
    use HasFactory;

    /**
     * 支払明細
     * @var string
     */
    protected $table = 'trn_pay_details';

    /**
     * @return BelongsTo
     */
    public function trnPayHeader()
    {
        return $this->belongsTo(TrnPayHeader::class, 'id', 'trn_pay_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function trnPurchaseDetail()
    {
        return $this->belongsTo(TrnPayHeader::class, 'id', 'trn_purchase_detail_id');
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
        return self::query()->select('trn_pay_header_id')->where('id', $id)->first();
    }

    /**
     * 明細IDによるID取得
     * @param $detailId
     * @return $model
     */
    static public function getIdByDetailId($detailId)
    {
        return self::query()->select('id')->where('trn_pay_header_id', $detailId)->first();
    }

}
