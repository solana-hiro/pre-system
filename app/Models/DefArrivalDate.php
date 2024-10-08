<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefArrivalDate extends Model
{
    use HasFactory;

    /**
     * 着日定義
     * @var string
     */
    protected $table = 'def_arrival_dates';

    /**
     * IDによるCode取得
     * @param $id
     * @return $code
     */
    static public function getCodeById($id)
    {
        return self::query()->select('arrival_date_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $id
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('arrival_date_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $code
     */
    static public function getNameById($id)
    {
        return self::query()->select('arrival_date_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $id
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('arrival_date_name')->where('arrival_date_cd', $code)->first();
    }

}
