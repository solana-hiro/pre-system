<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtOrderReceiveListNarrowDown extends Model
{
    use HasFactory;

    /**
     * 受注リスト絞込マスタ
     * @var string
     */
    protected $table = 'mt_order_receive_list_narrow_downs';

    /**
     * @return BelongsTo
     */
    public function mtRoot()
    {
        return $this->belongsTo(MtRoot::class, 'id', 'mt_root_id');
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
        return self::query()->select('extraction_condition_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('extraction_condition_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('extraction_condition_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('extraction_condition_name')->where('extraction_condition_cd', $code)->first();
    }

}
