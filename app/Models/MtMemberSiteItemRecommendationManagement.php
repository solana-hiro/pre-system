<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtMemberSiteItemRecommendationManagement extends Model
{
    use HasFactory;

    /**
     * メンバーサイト商品おすすめ管理マスタ
     * @var string
     */
    protected $table = 'mt_member_site_item_recommendation_managements';

    /**
     * @return BelongsTo
     */
    public function mtMemberSiteItemBase()
    {
        return $this->belongsTo(MtMemberSiteItem::class, 'id', 'mt_member_site_item_id_base');
    }

    /**
     * @return BelongsTo
     */
    public function mtMemberSiteItemRecommendation()
    {
        return $this->belongsTo(MtMemberSiteItem::class, 'id', 'mt_member_site_item_id_recommendation');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
