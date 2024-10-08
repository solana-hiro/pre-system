<?php
namespace App\Repositories\DefPsKbn;

use App\Models\DefPsKbn;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefPsKbnRepository implements DefPsKbnRepositoryInterface
{

    /**
     * PS区分情報取得 全件取得
     * @return Object
     */
    public function getAll() {
        //$result = DefPsKbn::orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
        $result = DefPsKbn::orderBy('sort_order')->get();
        return $result;
    }

    /**
     * PS区分情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params) {
        if(isset($params['ps_kbn_cd'])) {
		    $datas = DefPsKbn::where('ps_kbn_cd', '>=', $params['ps_kbn_cd'])->orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
        } else {
            $datas = DefPsKbn::orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
        }
		return $datas;
    }
}
