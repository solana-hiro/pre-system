<?php

namespace App\Repositories\DefDistrictClass;

use App\Models\DefDistrictClass;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefDistrictClassRepository implements DefDistrictClassRepositoryInterface
{

    /**
     * 地区分類定義情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = DefDistrictClass::orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 地区分類定義情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['district_class_cd'] ? CodeUtil::pad($params['district_class_cd'], 4) : null;
        $name = $params['district_class_name'] ?? null;

        $query = DefDistrictClass::query();
        $query->when($code, fn($query) => $query->where("district_class_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("district_class_name", 'like', "%$name%"));
        $query->orderBy('sort_order');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 地区分類 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['district_class_cd'] ? CodeUtil::pad($params['district_class_cd'], 4) : null;

        $query = DefDistrictClass::query();
        $query->where('district_class_cd', $code);

        return $query->first();
    }
}
