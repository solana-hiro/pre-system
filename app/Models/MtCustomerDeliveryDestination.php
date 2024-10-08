<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtCustomerDeliveryDestination extends Model
{
    use HasFactory;

    /**
     * 得意先別納品先マスタ
     * @var string
     */
    protected $table = 'mt_customer_delivery_destinations';

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
    public function mtDeliveryDestination()
    {
        return $this->belongsTo(MtDeliveryDestination::class, 'id', 'mt_delivery_destination_id');
    }

    /**
     * @return BelongsTo
     */
    public function defArrivalDate()
    {
        return $this->belongsTo(DefArrivalDate::class, 'id', 'def_arrival_date_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtRoot()
    {
        return $this->belongsTo(MtRoot::class, 'id', 'mt_root_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class_shipping_companie_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

}
