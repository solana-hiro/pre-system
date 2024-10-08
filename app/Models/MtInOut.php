<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtInOut extends Model
{
    use HasFactory;

    /**
     * 入出庫区分マスタ
     * @var string
     */
    protected $table = 'mt_in_out';

}
