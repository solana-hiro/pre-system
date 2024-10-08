<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtCart extends Model
{
    use HasFactory;

    /**
     * カートマスタ
     * @var string
     */
    protected $table = 'mt_carts';
}
