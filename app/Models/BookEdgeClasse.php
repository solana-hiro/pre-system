<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookEdgeClasse extends Model
{
    use HasFactory;

    /**
     * 帳端区分定義
     * @var string
     */
    protected $table = 'book_edge_classes';
}
