<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnShipmentDetail extends Model
{
    use HasFactory;

    /**
     * シップ決定明細
     * @var string
     */
    protected $table = 'trn_shipment_details';

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
        return self::query()->select('shipment_detail_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('shipment_detail_cd', $code)->first();
    }

}
