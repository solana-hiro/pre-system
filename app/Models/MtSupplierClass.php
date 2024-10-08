<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtSupplierClass extends Model
{
    use HasFactory;

    /**
     * 仕入先分類マスタ
     * @var string
     */
    protected $table = 'mt_supplier_classes';

    /**
     * @return BelongsTo
     */
    public function defSupplierClassThing()
    {
        return $this->belongsTo(DefSupplierClassThing::class, 'id', 'def_supplier_class_thing_id');
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
        return self::query()->select('def_supplier_class_thing_id', 'supplier_class_cd')->where('id', $id)->first();
    }

    /**
     * Code, 分類項目定義によるID取得
     * @param $code
     * @param $def_supplier_class_thing_id
     * @return $model
     */
    static public function getIdByCode($code, $def_supplier_class_thing_id)
    {
        return self::query()->select('id')->where('def_supplier_class_thing_id', $def_supplier_class_thing_id)->where('customer_class_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $code
     */
    static public function getNameById($id)
    {
        return self::query()->select('supplier_class_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @param $def_supplier_class_thing_id
     * @return $id
     */
    static public function getNameByCode($code, $def_supplier_class_thing_id)
    {
        return self::query()->select('supplier_class_name')->where('def_supplier_class_thing_id', $def_customer_class_thing_id)->where('customer_class_cd', $code)->first();
    }

}
