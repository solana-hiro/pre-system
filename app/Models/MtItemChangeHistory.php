<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtItemChangeHistory extends Model
{
    use HasFactory;

    /**
     * 商品変更履歴マスタ
     * @var string
     */
    protected $table = 'mt_item_change_histories';

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
    public function mtUser()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_id');
    }

    /**
     * @return BelongsTo
     */
    public function defItemChangeHistoryThing()
    {
        return $this->belongsTo(DefItemChangeHistoryThing::class, 'id', 'def_item_change_history_thing_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
