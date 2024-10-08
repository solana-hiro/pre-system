<?php
namespace App\Repositories\Def2Menu;

use App\Models\Def2Menu;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class Def2MenuRepository implements Def2MenuRepositoryInterface
{

    /**
     * メニュー情報取得(2階層目のみ)
     * @return Object
     */
    public function getDef2() {
        $def2 = Def2Menu::orderBy('sort_order')->get();
        return $def2;
    }
}
