<?php

namespace App\Repositories\DefDepartment;

use App\Models\DefDepartment;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefDepartmentRepository implements DefDepartmentRepositoryInterface
{

    /**
     * 部門情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = DefDepartment::orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 部門情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['department_cd'] ? CodeUtil::pad($params['department_cd'], 4) : null;
        $name = $params['department_name'] ?? null;

        $query = DefDepartment::query();
        $query->when($code, fn($query) => $query->where("department_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("department_name", 'like', "%$name%"));
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
        $code = $params['department_cd'] ? CodeUtil::pad($params['department_cd'], 4) : null;

        $query = DefDepartment::query();
        $query->where('department_cd', $code);

        return $query->first();
    }
}
