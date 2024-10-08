<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'mt_stock_keeping_unit_id',
        'shelf_number_1',
        'shelf_number_2',
        'rank',
    ];

    /**
     * ロケーションマスタ
     * @var string
     */
    protected $table = 'mt_locations';

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
    public function mtStockKeepingUnit()
    {
        return $this->belongsTo(MtStockKeepingUnit::class, 'id', 'mt_stock_keeping_unit_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    public function scopeJoinSkuDetail($query)
    {
        $query->join('mt_stock_keeping_units', 'mt_stock_keeping_units.id', 'mt_locations.mt_stock_keeping_unit_id');
        $query->join('mt_items', 'mt_items.id', 'mt_stock_keeping_units.mt_item_id');
        $query->join('mt_colors', 'mt_colors.id', 'mt_stock_keeping_units.mt_color_id');
        $query->join('mt_sizes', 'mt_sizes.id', 'mt_stock_keeping_units.mt_size_id');
    }
}
