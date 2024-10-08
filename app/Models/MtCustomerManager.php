<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtCustomerManager extends Model
{
    use HasFactory;

    /**
     * 得意先別担当者マスタ
     * @var string
     */
    protected $table = 'mt_customer_managers';

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
    public function mtManager()
    {
        return $this->belongsTo(MtManager::class, 'mt_manager_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }
}
