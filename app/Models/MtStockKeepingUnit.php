<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtStockKeepingUnit extends Model
{
    use HasFactory;

    /**
     * SKUマスタ
     * @var string
     */
    protected $table = 'mt_stock_keeping_units';

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
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    public function scopeJoinColorAndSize($query)
    {
        $query->join('mt_colors', 'mt_colors.id', 'mt_stock_keeping_units.mt_color_id');
        $query->join('mt_sizes', 'mt_sizes.id', 'mt_stock_keeping_units.mt_size_id');
    }

    public function scopeLeftJoinLocation($query, $warehouseId)
    {
        $query->leftJoin('mt_locations', function ($join) use ($warehouseId) {
            $join->on('mt_locations.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id');
            $join->on('mt_locations.mt_warehouse_id', '=', $warehouseId);
        });
    }
}
