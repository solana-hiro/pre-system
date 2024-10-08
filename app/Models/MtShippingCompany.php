<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtShippingCompany extends Model
{
    use HasFactory;

    /**
     * 運送会社マスタ
     * @var string
     */
    protected $table = 'mt_shipping_companies';


    /**
     * @return BelongsTo
     */
    public function mtSlipKind7()
    {
        return $this->belongsTo(MtSlipKind::class, 'id', 'mt_slip_kind7_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtSlipKind17()
    {
        return $this->belongsTo(MtSlipKind::class, 'id', 'mt_slip_kind17_id');
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
        return self::query()->select('shipping_company_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('shipping_company_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('shipping_company_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('shipping_company_name')->where('shipping_company_cd', $code)->first();
    }
}
