<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnPaySequentiallyPayDestinationIntelligence extends Model
{
    use HasFactory;

    /**
     * 支払時支払先情報
     * @var string
     */
    protected $table = 'trn_pay_sequentially_pay_destination_intelligences';
}
