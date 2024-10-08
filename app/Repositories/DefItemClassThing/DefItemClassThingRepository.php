<?php
namespace App\Repositories\DefItemClassThing;

use App\Models\DefItemClassThing;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefItemClassThingRepository implements DefItemClassThingRepositoryInterface
{

    /**
     *商品分類項目定義情報取得 全件取得
     * @return Object
     */
    public function getAll() {
		$result = DefItemClassThing::orderBy('sort_order')->get();
		return $result;
    }

    /**
     *商品分類項目定義情報取得 ID指定
     * @param int
     * @return Object
     */
    public function getById($id)
    {
        $result = DefItemClassThing::where('id', $id)->first();
        return $result;
    }
}
