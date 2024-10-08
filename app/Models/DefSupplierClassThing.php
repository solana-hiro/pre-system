<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefSupplierClassThing extends Model
{
    use HasFactory;

    /**
     * 仕入先分類項目定義
     * @var string
     */
    protected $table = 'def_supplier_class_things';
}
