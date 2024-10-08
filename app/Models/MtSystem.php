<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtSystem extends Model
{
    use HasFactory;

    /**
     * システムマスタ
     * @var string
     */
    protected $table = 'mt_system';

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
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
