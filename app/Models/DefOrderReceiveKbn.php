<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefOrderReceiveKbn extends Model
{
    use HasFactory;

    /**
     * 受注区分定義
     * @var string
     */
    protected $table = 'def_order_receive_kbns';

    /**
     * IDによるCode取得
     * @param $id
     * @return $model
     */
    static public function getCodeById($id)
    {
        return self::query()->select('order_receive_kbn_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('order_receive_kbn_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('order_receive_kbn_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('order_receive_kbn_name')->where('order_receive_kbn_cd', $code)->first();
    }

}
