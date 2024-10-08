<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WkInventoryBase extends Model
{
    use HasFactory;

    /**
     * 棚卸ベースワーク
     * @var string
     */
    protected $table = 'wk_inventory_bases';

    /**
     * @return BelongsTo
     */
    public function mtWarehouse()
    {
        return $this->belongsTo(MtWarehouse::class, 'id', 'mt_warehouse_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItem()
    {
        return $this->belongsTo(MtItem::class, 'id', 'mt_item_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtColor()
    {
        return $this->belongsTo(MtColor::class, 'id', 'mt_color_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtSize()
    {
        return $this->belongsTo(MtSize::class, 'id', 'mt_size_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtLocation()
    {
        return $this->belongsTo(MtLocation::class, 'id', 'mt_location_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    /**
     * IDによるNumber取得
     * @param $id
     * @return $model
     */
    static public function getNumberById($id)
    {
        return self::query()->select('payment_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('payment_number', $number)->first();
    }
}
