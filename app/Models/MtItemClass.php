<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtItemClass extends Model
{
    use HasFactory;

    /**
     * 商品分類マスタ
     * @var string
     */
    protected $table = 'mt_item_classes';

    /**
     * @return BelongsTo
     */
    public function DefItemClassThing()
    {
        return $this->belongsTo(DefItemClassThing::class, 'id', 'def_item_class_thing_id');
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
        return self::query()->select('def_item_class_thing_id', 'item_class_cd')->where('id', $id)->first();
    }

    /**
     * Code, 分類項目定義によるID取得
     * @param $code
     * @param $def_supplier_class_thing_id
     * @return $model
     */
    static public function getIdByCode($code, $def_item_class_thing_id)
    {
        return self::query()->select('id')->where('def_item_class_thing_id', $def_item_class_thing_id)->where('item_class_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $code
     */
    static public function getNameById($id)
    {
        return self::query()->select('item_class_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @param $def_supplier_class_thing_id
     * @return $id
     */
    static public function getNameByCode($code, $def_item_class_thing_id)
    {
        return self::query()->select('item_class_name')->where('def_item_class_thing_id', $def_item_class_thing_id)->where('item_class_cd', $code)->first();
    }

}
