<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtUser1Security extends Model
{
    use HasFactory;

    /**
     * ユーザセキュリティ1マスタ
     * @var string
     */
    protected $table = 'mt_user_1_securities';

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
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

}
