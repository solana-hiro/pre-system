<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefDepartment extends Model
{
    use HasFactory;

    /**
     * 部門定義
     * @var string
     */
    protected $table = 'def_departments';

}
