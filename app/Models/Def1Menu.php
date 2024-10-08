<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Def1Menu extends Model
{
    use HasFactory;

    /**
     * メニュー1定義
     * @var string
     */
    protected $table = 'def_1_menus';

    /**
     * @return HasMany
     */
    public function def2Menus()
    {
        return $this->hasMany(Def2Menu::class, 'id', 'def_2_menu_id');
    }

    /**
     * @return HasMany
     */
    public function def3Menus()
    {
        return $this->hasMany(Def3Menu::class, 'id', 'def_3_menu_id');
    }

}
