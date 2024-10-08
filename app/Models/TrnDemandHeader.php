<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnDemandHeader extends Model
{
    use HasFactory;

    /**
     * 請求ヘッダ
     * @var string
     */
    protected $table = 'trn_demand_headers';

    /**
     * @return BelongsTo
     */
    public function mtBillingAddress()
    {
        return $this->belongsTo(MtBillingAddress::class, 'id', 'mt_illing_address_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    /**
     * IDによるNumber取得
     * @param $id
     * @return $model
     */
    static public function getNumberById($id)
    {
        return self::query()->select('demand_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('demand_number', $number)->first();
    }

}
