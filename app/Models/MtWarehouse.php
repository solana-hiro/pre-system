<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtWarehouse extends Model
{
    use HasFactory;

    /**
     * 倉庫マスタ
     * @var string
     */
    protected $table = 'mt_warehouses';
    protected $appends = ['kind_label'];
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
        return self::query()->select('warehouse_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('warehouse_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('warehouse_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('warehouse_name')->where('warehouse_cd', $code)->first();
    }

    /**
     * Enumの代わり
     * @param $code
     * @return $model
     */
    public function getKindLabelAttribute()
    {
        switch ($this->attributes['warehouse_kind']) {
            case 0:
                $kind_label = '0：通常';
                break;
            case 1:
                $kind_label = '1：委託';
                break;
            case 2:
                $kind_label = '2：直営';
                break;
            default:
                $kind_label = '';
        }

        return $kind_label;
    }
}
