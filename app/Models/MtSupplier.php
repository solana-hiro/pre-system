<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtSupplier extends Model
{
    use HasFactory;

    /**
     * 仕入先マスタ
     * @var string
     */
    protected $table = 'mt_suppliers';

    /**
     * @return BelongsTo
     */
    public function mtPayDestination()
    {
        return $this->belongsTo(MtPayDestination::class);
    }

    /**
     * @return BelongsTo
     */
    public function mtSupplierClass1()
    {
        return $this->belongsTo(MtSupplierClass::class, 'id', 'mt_supplier_class1_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtSupplierClass2()
    {
        return $this->belongsTo(MtSupplierClass::class, 'id', 'mt_supplier_class2_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtSupplierClass3()
    {
        return $this->belongsTo(MtSupplierClass::class, 'id', 'mt_supplier_class3_id');
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
    public function mtSlipKind()
    {
        return $this->belongsTo(MtSlipKind::class, 'id', 'mt_slip_kind_order_id');
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
        return self::query()->select('supplier_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('supplier_cd', $code)->first();
    }

    /**
     * IDによるName取得
     * @param $id
     * @return $model
     */
    static public function getNameById($id)
    {
        return self::query()->select('supplier_name')->where('id', $id)->first();
    }

    /**
     * CodeによるName取得
     * @param $code
     * @return $model
     */
    static public function getNameByCode($code)
    {
        return self::query()->select('supplier_name')->where('supplier_cd', $code)->first();
    }
}
