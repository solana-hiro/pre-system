<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrnSaleHeader extends Model
{
    use HasFactory;

    /**
     * 売上ヘッダ
     * @var string
     */
    protected $table = 'trn_sale_headers';

    /**
     * @return BelongsTo
     */
    public function mtUserInput()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_register_id');
    }

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
    public function mtCustomerClass()
    {
        return $this->belongsTo(MtCustomerClass::class, 'id', 'mt_customer_class1_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserManager()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtSlipKind()
    {
        return $this->belongsTo(MtSlipKind::class, 'id', 'mt_slip_kind_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtDeliveryDestination()
    {
        return $this->belongsTo(mtDeliveryDestination::class, 'id', 'mt_delivery_destination_id');
    }

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
    public function mtCustomer()
    {
        return $this->belongsTo(MtCustomer::class);
    }

    /**
     * @return BelongsTo
     */
    public function trnDemandHeader()
    {
        return $this->belongsTo(TrnDemandHeader::class, 'id', 'trn_demand_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    public function trnSaleDetails()
    {
        return $this->hasMany(TrnSaleDetail::class);
    }

    /**
     * IDによるNumber取得
     * @param $id
     * @return $model
     */
    static public function getNumberById($id)
    {
        return self::query()->select('sale_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('sale_number', $number)->first();
    }
}
