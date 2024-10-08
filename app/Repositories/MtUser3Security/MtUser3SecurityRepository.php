<?php
namespace App\Repositories\MtUser3Security;

use App\Models\MtUser3Security;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class MtUser3SecurityRepository implements MtUser3SecurityRepositoryInterface
{

    /**
     * メニュー情報取得(3階層目のみ)
     * @return Object
     */
    public function getUser3Security() {
        $def3 = MtUser3Security::get();
        return $def3;
    }
}
