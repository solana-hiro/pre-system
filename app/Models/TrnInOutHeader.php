<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnInOutHeader extends Model
{
    use HasFactory;

    /**
     * 入出庫ヘッダ
     * @var string
     */
    protected $table = 'trn_in_out_headers';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'in_out_number',
        'slip_date',
        'mt_user_id',
        'mt_warehouse_issue_id',
        'mt_warehouse_warehousing_id',
        'slip_memo',
        'total_quantity',
        'def_in_out_kbn_id',
        'mt_user_last_update_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function defInOutKbn()
    {
        return $this->belongsTo(DefInOutKbn::class, 'def_in_out_kbn_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUser()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_id');
    }

    /**
     * @return HasMany
     */
    public function trnInOutDetails()
    {
        return $this->hasMany(TrnInOutDetail::class, 'trn_in_out_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function trnOrderReceiveHeader()
    {
        return $this->belongsTo(TrnOrderReceiveHeader::class, 'trn_order_receive_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtWarehouseIssue()
    {
        return $this->belongsTo(MtWarehouse::class, 'mt_warehouse_issue_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtWarehousing()
    {
        return $this->belongsTo(MtWarehouse::class, 'mt_warehouse_warehousing_id');
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
        return self::query()->select('in_out_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('in_out_number', $number)->first();
    }
}
