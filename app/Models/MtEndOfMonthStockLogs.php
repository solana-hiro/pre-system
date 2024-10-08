<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtEndOfMonthStockLogs extends Model
{
    use HasFactory;

    /**
     * 月末在庫ログ
     * @var string
     */
    protected $table = 'mt_end_of_month_stock_logs';
}
