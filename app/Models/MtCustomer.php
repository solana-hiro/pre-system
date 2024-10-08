<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtCustomer extends Model
{
    use HasFactory;

    /**
     * 得意先マスタ
     * @var string
     */
    protected $table = 'mt_customers';

    /**
     * @return BelongsTo
     */
    public function mtBillingAddress()
    {
        return $this->belongsTo(MtBillingAddress::class, 'mt_billing_address_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtOrderReceiveStickyNote()
    {
        return $this->belongsTo(MtOrderReceiveStickyNote::class, 'mt_order_receive_sticky_note_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtCustomerManagers()
    {
        return $this->hasMany(MtCustomerManager::class)->with('mtManager');
    }

    /**
     * @return BelongsTo
     */
    public function defDistrictClass()
    {
        return $this->belongsTo(DefDistrictClass::class, 'id', 'def_district_class_id');
    }

    /**
     * @return BelongsTo
     */
    public function defPioneerYear()
    {
        return $this->belongsTo(DefPioneerYear::class, 'id', 'def_pioneer_year_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtCustomerClass1()
    {
        return $this->belongsTo(MtCustomerClass::class, 'id', 'mt_customer_class1_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtCustomerClass2()
    {
        return $this->belongsTo(MtCustomerClass::class, 'id', 'mt_customer_class2_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtCustomerClass3()
    {
        return $this->belongsTo(MtCustomerClass::class, 'id', 'mt_customer_class3_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUser()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_id');
    }


    /**
     * @return BelongsTo
     */
    public function mtWarehouse()
    {
        return $this->belongsTo(MtWarehouse::class, 'id', 'mt_warehouse_order_receive_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtRoot()
    {
        return $this->belongsTo(MtRoot::class);
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass()
    {
        return $this->belongsTo(MtItemClass::class, 'mt_item_class_shipping_companie_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function mtSlipKind()
    {
        return $this->belongsTo(mtSlipKind::class, 'id', 'mt_slip_kind_sale_id');
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
    public function mtUserRegister()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_register_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    /**
     * IDによるCode取得
     * @param $id
     * @return $model
     */
    static public function getCodeById($id)
    {
        return self::query()->select('customer_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('user_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('customer_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('customer_name')->where('customer_cd', $code)->first();
    }
}
