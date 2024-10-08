<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WkInventoryAchievement extends Model
{
    use HasFactory;

    /**
     * 棚卸実績ワーク
     * @var string
     */
    protected $table = 'wk_inventory_achievements';

    /**
     * @return BelongsTo
     */
    public function wkInventoryBase()
    {
        return $this->belongsTo(WkInventoryBase::class, 'id', 'wk_inventory_baseid');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
