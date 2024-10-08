<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnPayHeader extends Model
{
    use HasFactory;

    /**
     * 支払ヘッダ
     * @var string
     */
    protected $table = 'trn_payment_headers';

    /**
     * @return BelongsTo
     */
    public function mtSupplier()
    {
        return $this->belongsTo(MtSupplier::class, 'id', 'mt_supplier_id');
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
        return self::query()->select('pay_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('pay_number', $number)->first();
    }

}
