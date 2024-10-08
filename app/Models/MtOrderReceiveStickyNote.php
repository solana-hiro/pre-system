<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtOrderReceiveStickyNote extends Model
{
    use HasFactory;

    /**
     * 受注付箋マスタ
     * @var string
     */
    protected $table = 'mt_order_receive_sticky_notes';

    /**
     * @return BelongsTo
     */
    public function defStickyNoteKind()
    {
        return $this->belongsTo(DefStickyNoteKind::class, 'id', 'def_sticky_note_kind_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
