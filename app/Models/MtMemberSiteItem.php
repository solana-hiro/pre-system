<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtMemberSiteItem extends Model
{
    use HasFactory;

    /**
     * メンバーサイト商品マスタ
     * @var string
     */
    protected $table = 'mt_member_site_items';

    /**
     * @return BelongsTo
     */
    public function mtItemClass1()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class1_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass2()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class2_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass3()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class3_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass4()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class4_id');
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
        return self::query()->select('ec_item_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('ec_item_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('ec_item_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('ec_item_name')->where('ec_item_cd', $code)->first();
    }
}
