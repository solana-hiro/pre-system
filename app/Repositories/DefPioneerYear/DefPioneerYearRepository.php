<?php

namespace App\Repositories\DefPioneerYear;

use App\Models\DefPioneerYear;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefPioneerYearRepository implements DefPioneerYearRepositoryInterface
{

    /**
     * 開拓年分類情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = DefPioneerYear::paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 開拓年分類情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['pioneer_year_cd'] ? CodeUtil::pad($params['pioneer_year_cd'], 4) : null;
        $name = $params['pioneer_year_name'] ?? null;

        $query = DefPioneerYear::query();
        $query->when($code, fn($query) => $query->where("pioneer_year_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("pioneer_year_name", 'like', "%$name%"));
        $query->orderBy('pioneer_year_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 開拓年分類 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['pioneer_year_cd'] ? CodeUtil::pad($params['pioneer_year_cd'], 4) : null;

        $query = DefPioneerYear::query();
        $query->where('pioneer_year_cd', $code);

        return $query->first();
    }
}
