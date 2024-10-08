<?php

namespace App\Repositories\DefInOutKbn;

use App\Models\DefInOutKbn;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use App\Models\DefInOutKbn as ModelsDefInOutKbn;
use App\Repositories\DefInOutKbn\DefInOutKbnRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefInOutKbnRepository implements DefInOutKbnRepositoryInterface
{

    /**
     * 部門情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = ModelsDefInOutKbn::orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 部門情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $query = DefInOutKbn::query();
        $query->orderBy('sort_order');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 部門 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['in_out_kbn_cd'] ? CodeUtil::pad($params['in_out_kbn_cd'], 4) : null;

        $query = DefInOutKbn::query();
        $query->where('department_cd', $code);

        return $query->first();
    }
}
