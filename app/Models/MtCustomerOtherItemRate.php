<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtCustomerOtherItemRate extends Model
{
    use HasFactory;

    /**
     * 得意先別商品掛率マスタ
     * @var string
     */
    protected $table = 'mt_customer_other_item_rates';

    /**
     * @return BelongsTo
     */
    public function mtCustomer()
    {
        return $this->belongsTo(MtCustomer::class, 'id', 'mt_customer_id');
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

    public function dataBackup()
    {
        $this->old_rate = $this->rate;
        $this->old_start_date = $this->start_date;
        $this->old_end_date = $this->end_date;
    }
}
