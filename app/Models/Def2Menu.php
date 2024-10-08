<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Def2Menu extends Model
{
    use HasFactory;

    /**
     * メニュー2定義
     * @var string
     */
    protected $table = 'def_2_menus';

    /**
     * @return HasMany
     */
    public function def3Menus()
    {
        return $this->hasMany(Def3Menu::class, 'id', 'def_3_menu_id');
    }

    /**
     * @return BelongsTo
     */
    public function def1Menu()
    {
        return $this->belongsTo(def1Menu::class, 'id', 'def_1_menu_id');
    }
}
