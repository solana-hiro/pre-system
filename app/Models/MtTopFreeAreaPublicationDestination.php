<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtTopFreeAreaPublicationDestination extends Model
{
    use HasFactory;

    /**
     * TOP自由領域公開先マスタ
     * @var string
     */
    protected $table = 'mt_top_free_area_publication_destinations';

    /**
     * @return BelongsTo
     */
    public function mtTopFreeArea()
    {
        return $this->belongsTo(MtTopFreeArea::class, 'id', 'mt_top_free_area_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
