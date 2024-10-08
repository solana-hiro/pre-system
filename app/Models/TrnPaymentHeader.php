<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnPaymentHeader extends Model
{
    use HasFactory;

    /**
     * 入金ヘッダ
     * @var string
     */
    protected $table = 'trn_payment_headers';

    /**
     * @return BelongsTo
     */
    public function mtCustomer()
    {
        return $this->belongsTo(MtCustomer::class, 'id', 'mt_customer_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUser()
    {
        return $this->belongsTo(MtCustomer::class, 'id', 'mt_user_id');
    }

    /**
     * @return BelongsTo
     */
    public function trnDemandHeader()
    {
        return $this->belongsTo(TrnDemandHeader::class, 'id', 'trn_demand_header_id');
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
        return self::query()->select('payment_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('payment_number', $number)->first();
    }
}
