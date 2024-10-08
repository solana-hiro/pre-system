<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WkInventoryDetail extends Model
{
    use HasFactory;

    /**
     * 棚卸明細
     * @var string
     */
    protected $table = 'wk_inventory_details';

    /**
     * IDによるCode取得
     * @param $id
     * @return $model
     */
    static public function getCodeById($id)
    {
        return self::query()->select('inventory_detail_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('inventory_detail_cd', $code)->first();
    }

}
