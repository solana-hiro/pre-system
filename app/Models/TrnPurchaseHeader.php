<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnPurchaseHeader extends Model
{
    use HasFactory;

    /**
     * 仕入ヘッダ
     * @var string
     */
    protected $table = 'trn_purchase_headers';

    /**
     * @return BelongsTo
     */
    public function trnOrderHeader()
    {
        return $this->belongsTo(TrnOrderHeader::class, 'id', 'trn_order_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserInput()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_input_id');
    }

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
    public function mtSupplierClass()
    {
        return $this->belongsTo(MtSupplierClass::class, 'id', 'mt_supplier_class_id');
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
    public function defDepartment()
    {
        return $this->belongsTo(DefDepartment::class, 'id', 'def_department_id');
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

    /**
     * IDによるNumber取得
     * @param $id
     * @return $model
     */
    static public function getNumberById($id)
    {
        return self::query()->select('purchase_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('purchase_number', $number)->first();
    }

}
