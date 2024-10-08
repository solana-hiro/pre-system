<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Def3Menu extends Model
{
    use HasFactory;

    /**
     * メニュー3定義
     * @var string
     */
    protected $table = 'def_3_menus';

    /**
     * @return BelongsTo
     */
    public function def1Menu()
    {
        return $this->belongsTo(Def1Menu::class, 'def_1_menu_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function def2Menu()
    {
        return $this->belongsTo(Def2Menu::class, 'def_2_menu_id', 'id');
    }
}
