<?php
namespace App\Repositories\DefCustomerClassThing;

use App\Models\DefCustomerClassThing;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefCustomerClassThingRepository implements DefCustomerClassThingRepositoryInterface
{

    /**
     * 得意先分類項目定義情報取得 全件取得
     * @return Object
     */
    public function getAll() {
		$result = DefCustomerClassThing::orderBy('sort_order')->get();
		return $result;
    }

}
