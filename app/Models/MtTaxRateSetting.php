<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtTaxRateSetting extends Model
{
    use HasFactory;

    /**
     * 税率設定マスタ
     * @var string
     */
    protected $table = 'mt_tax_rate_settings';

    /**
     * @return BelongsTo
     */
    public function defTaxRateKbn()
    {
        return $this->belongsTo(DefTaxRateKbn::class, 'id', 'def_tax_rate_kbn_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
