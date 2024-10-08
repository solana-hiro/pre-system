<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtUser2Security extends Model
{
    use HasFactory;

    /**
     * ユーザセキュリティ2マスタ
     * @var string
     */
    protected $table = 'mt_user_2_securities';

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
    public function def1Menu()
    {
        return $this->belongsTo(Def1Menu::class, 'id', 'def_1_menu_id');
    }

    /**
     * @return BelongsTo
     */
    public function def2Menu()
    {
        return $this->belongsTo(Def2Menu::class, 'id', 'def_2_menu_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
