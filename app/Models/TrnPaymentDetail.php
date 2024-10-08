<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnPaymentDetail extends Model
{
    use HasFactory;

    /**
     * 入金明細
     * @var string
     */
    protected $table = 'trn_payment_details';

    /**
     * @return BelongsTo
     */
    public function trnPaymentHeader()
    {
        return $this->belongsTo(TrnPaymentHeader::class, 'id', 'trn_payment_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function defPaymentKbn()
    {
        return $this->belongsTo(DefPaymentKbn::class, 'id', 'def_payment_kbn_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtBank()
    {
        return $this->belongsTo(MtBank::class, 'id', 'mt_bank_id');
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
        return self::query()->select('payment_detail_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('payment_detail_cd', $code)->first();
    }

}
