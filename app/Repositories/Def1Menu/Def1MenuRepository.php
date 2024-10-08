<?php

namespace App\Repositories\Def1Menu;

use App\Models\Def1Menu;
use App\Models\Def2Menu;
use App\Models\Def3Menu;
use App\Models\MtUser1Security;
use App\Models\MtUser2Security;
use App\Models\MtUser3Security;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class Def1MenuRepository implements Def1MenuRepositoryInterface
{
    /**
     * メニュー情報取得
     * @return Object
     */
    public function getAll()
    {
        $defLists = array();
        $defLists['def1'] = Def1Menu::orderBy('sort_order')->get();
        $defLists['def2'] = Def2Menu::orderBy('sort_order')->get();
        $defLists['def3'] = Def3Menu::orderBy('sort_order')->get();
        return $defLists;
    }

    /**
     * メニュー情報取得(1階層目のみ)
     * @return Object
     */
    public function getDef1()
    {
        $def1 = Def1Menu::orderBy('sort_order')->get();
        return $def1;
    }
}
