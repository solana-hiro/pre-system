<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtThingName extends Model
{
    use HasFactory;

    /**
     * 項目名マスタ
     * @var string
     */
    protected $table = 'mt_thing_names';

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
