<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefShippingStatusKbn extends Model
{
    use HasFactory;

    /**
     * 出荷状態区分定義
     * @var string
     */
    protected $table = 'def_shipping_status_kbns';

    /**
     * IDによるCode取得
     * @param $id
     * @return $model
     */
    static public function getCodeById($id)
    {
        return self::query()->select('shipping_status_kbn_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('shipping_status_kbn_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('shipping_status_kbn_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('shipping_status_kbn_name')->where('shipping_status_kbn_cd', $code)->first();
    }
}
