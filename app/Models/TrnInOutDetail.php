<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnInOutDetail extends Model
{
    use HasFactory;

    /**
     * 入出庫明細
     * @var string
     */
    protected $table = 'trn_in_out_details';

    /**
     * 追加コラム
     * @var array
     */
    protected $fillable = [
        'id',
        'in_out_detail_cd',
        'trn_in_out_header_id',
        'mt_item_id',
        'retail_price_tax_out',
        'memo',
        'mt_user_last_update_id',
        'order_line_no',
        'item_name',
    ];

    /**
     * 追加コラム
     * @var array
     */
    protected $appends = [
        'total_quantity',
    ];

    /**
     * @return 数字
     */
    public function getTotalQuantityAttribute() {
        return $this->trnInOutBreakdowns()->sum('order_in_out_quantity');
    }

    /**
     * @return hasMany
     */
    public function trnInOutBreakdowns() {
        return $this->hasMany(TrnInOutBreakdown::class, 'trn_in_out_detail_id');
    }

    /**
     * @return BelongsTo
     */
    public function trnOrderReceiveDetail()
    {
        return $this->belongsTo(TrnOrderReceiveDetail::class, 'id', 'trn_order_receive_detail_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItem()
    {
        return $this->belongsTo(MtItem::class, 'mt_item_id');
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
        return self::query()->select('in_out_detail_cd')->where('id', $id)->first();
    }

    /**
     * CodeによるID取得
     * @param $code
     * @return $model
     */
    static public function getIdByCode($code)
    {
        return self::query()->select('id')->where('in_out_detail_cd', $code)->first();
    }

}
