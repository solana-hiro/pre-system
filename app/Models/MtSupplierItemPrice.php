<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtSupplierItemPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'mt_item_id',
        'set_date',
        'price',
    ];

    /**
     * 仕入先商品単価マスタ
     * @var string
     */
    protected $table = 'mt_supplier_item_prices';

    /**
     * @return BelongsTo
     */
    public function mtSupplier()
    {
        return $this->belongsTo(MtSupplier::class, 'id', 'mt_supplier_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItem()
    {
        return $this->belongsTo(MtItem::class);
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
