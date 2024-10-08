<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtSlipKind extends Model
{
    use HasFactory;

    /**
     * 伝票種別マスタ
     * @var string
     */
    protected $table = 'mt_slip_kinds';

    /**
     * @return BelongsTo
     */
    public function defSlipKindKbn()
    {
        return $this->belongsTo(DefSlipKindKbn::class, 'id', 'def_slip_kind_kbn_id');
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
        return self::query()->select('def_slip_kind_kbn_id', 'slip_kind_cd')->where('id', $id)->first();
    }

    /**
     * Code, 分類項目定義によるID取得
     * @param $code
     * @param $def_slip_kind_kbn_id
     * @return $model
     */
    static public function getIdByCode($code, $def_slip_kind_kbn_id)
    {
        return self::query()->select('id')->where('def_slip_kind_kbn_id', $def_slip_kind_kbn_id)->where('slip_kind_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $code
     */
    static public function getNameById($id)
    {
        return self::query()->select('slip_kind_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @param $def_slip_kind_kbn_id
     * @return $id
     */
    static public function getNameByCode($code, $def_slip_kind_kbn_id)
    {
        return self::query()->select('slip_kind_name')->where('def_slip_kind_kbn_id', $def_slip_kind_kbn_id)->where('slip_kind_cd', $code)->first();
    }

}
