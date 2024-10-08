<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtTopFreeArea extends Model
{
    use HasFactory;

    /**
     * TOP自由領域マスタ
     * @var string
     */
    protected $table = 'mt_top_free_areas';

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
        return self::query()->select('area_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('area_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('area_title')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('area_title')->where('area_cd', $code)->first();
    }
}
