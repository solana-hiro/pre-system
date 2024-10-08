<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtCatalogItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'mt_catalog_id', 
        'mt_member_site_items_id',
        'display_sort_order',
    ]; 

    /**
     * カタログ別商品マスタ
     * @var string
     */
    protected $table = 'mt_catalog_items';

    /**
     * @return BelongsTo
     */
    public function mtCatalog()
    {
        return $this->belongsTo(MtCatalog::class, 'id', 'mt_catalog_id');
    }

    /**
     * @return BelongsTo
     */
    public function MtMemberSiteItem()
    {
        return $this->belongsTo(MtMemberSiteItem::class, 'id', 'mt_member_site_items_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
