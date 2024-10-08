<?php
namespace App\Repositories\Def3Menu;

use App\Models\Def3Menu;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class Def3MenuRepository implements Def3MenuRepositoryInterface
{

    /**
     * メニュー情報取得(3階層目のみ)
     * @return Object
     */
    public function getDef3() {
        $def3 = Def3Menu::orderBy('sort_order')->get();
        return $def3;
    }
}
