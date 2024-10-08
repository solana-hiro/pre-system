<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtCustomerClass extends Model
{
    use HasFactory;

    /**
     * 得意先分類マスタ
     * @var string
     */
    protected $table = 'mt_customer_classes';

    /**
     * @return BelongsTo
     */
    public function defCustomerClassThing()
    {
        return $this->belongsTo(DefCustomerClassThing::class, 'id', 'def_customer_class_thing_id');
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
        return self::query()->select('def_customer_class_thing_id', 'customer_class_cd', 'customer_class_name')->where('id', $id)->first();
    }

    /**
     * Code, 分類項目定義によるID取得
     * @param $code
     * @param $def_customer_class_thing_id
     * @return $model
     */
    static public function getIdByCode($code, $def_customer_class_thing_id)
    {
        return self::query()->select('id')->where('def_customer_class_thing_id', $def_customer_class_thing_id)->where('customer_class_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $code
     */
    static public function getNameById($id)
    {
        return self::query()->select('customer_class_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @param $def_customer_class_thing_id
     * @return $id
     */
    static public function getNameByCode($code, $def_customer_class_thing_id)
    {
        return self::query()->select('customer_class_name')->where('def_customer_class_thing_id', $def_customer_class_thing_id)->where('customer_class_cd', $code)->first();
    }

}
