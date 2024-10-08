<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnPurchaseDetail extends Model
{
    use HasFactory;

    /**
     * 仕入明細
     * @var string
     */
    protected $table = 'trn_purchase_details';

    /**
     * @return BelongsTo
     */
    public function trnPurchaseHeader()
    {
        return $this->belongsTo(TrnPurchaseHeader::class, 'id', 'trn_purchase_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function trnShipmentDetail()
    {
        return $this->belongsTo(TrnShipmentDetail::class, 'id', 'trn_shipment_detail_id');
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
        return self::query()->select('purchase_detail_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('purchase_detail_cd', $code)->first();
    }

}
