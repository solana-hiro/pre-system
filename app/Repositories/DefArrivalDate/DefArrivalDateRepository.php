<?php

namespace App\Repositories\DefArrivalDate;

use App\Models\DefArrivalDate;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefArrivalDateRepository implements DefArrivalDateRepositoryInterface
{

    /**
     * 着日定義情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = DefArrivalDate::orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 着日定義情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['arrival_date_cd'] ? CodeUtil::pad($params['arrival_date_cd'], 4) : null;
        $name = $params['arrival_date_name'] ?? null;

        $query = DefArrivalDate::query();
        $query->when($code, fn($query) => $query->where("arrival_date_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("arrival_date_name", 'like', "%$name%"));
        $query->orderBy('sort_order');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['arrival_date_cd'] ? CodeUtil::pad($params['arrival_date_cd'], 4) : null;

        $query = DefArrivalDate::query();
        $query->where('arrival_date_cd', $code);

        return $query->first();
    }
}
