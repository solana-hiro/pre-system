<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numbering extends Model
{
    use HasFactory;

    /**
     * 採番情報
     * @var string
     */
    protected $table = 'numbering';
}
