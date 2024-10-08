<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtItem extends Model
{
    use HasFactory;

    /**
     * 商品マスタ
     * @var string
     */
    protected $table = 'mt_items';

    /**
     * @return BelongsTo
     */
    public function mtSupplier()
    {
        return $this->belongsTo(MtSupplier::class, 'id', 'mt_supplier_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass5()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class5_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass6()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class6_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass7()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class7_id');
    }

    /**
     * @return BelongsTo
     */
    public function defTaxRateKbn()
    {
        return $this->belongsTo(DefTaxRateKbn::class, 'id', 'def_tax_rate_kbns_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtMemberSiteItem()
    {
        return $this->belongsTo(MtMemberSiteItem::class, 'id', 'mt_member_site_item_id');
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
        return self::query()->select('item_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('item_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('item_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('item_name')->where('item_cd', $code)->first();
    }
}
