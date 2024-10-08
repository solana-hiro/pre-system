<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnShipping extends Model
{
    use HasFactory;

    /**
     * 出荷情報
     * @var string
     */
    protected $table = 'trn_shippings';

    /**
     * @return BelongsTo
     */
    public function trnOrderReceiveHeader()
    {
        return $this->belongsTo(TrnOrderReceiveHeader::class, 'id', 'trn_order_receive_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUser()
    {
        return $this->belongsTo(mtUser::class, 'id', 'mt_user_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtShippingCompany()
    {
        return $this->belongsTo(mtShippingCompany::class, 'id', 'mt_shipping_company_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
