<?php

namespace App\Repositories\MtSlipKind;

use App\Models\MtSlipKind;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class MtSlipKindRepository implements MtSlipKindRepositoryInterface
{

    /**
     * 伝票種別情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtSlipKind::select('mt_slip_kinds.*', 'def_slip_kind_kbns.*')
            ->leftJoin('def_slip_kind_kbns', 'mt_slip_kinds.def_slip_kind_kbn_id', 'def_slip_kind_kbns.id')
            ->where('def_slip_kind_kbn_id', 4)
            ->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 伝票種別情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $slipKindKbnCd = $params['slip_kind_kbn_cd'];
        $slipKindCd = $params['slip_kind_cd'] ? CodeUtil::pad($params['slip_kind_cd'], 3) : null;

        $query = MtSlipKind::query();
        $query->select('mt_slip_kinds.*');
        $query->leftJoin('def_slip_kind_kbns', 'mt_slip_kinds.def_slip_kind_kbn_id', 'def_slip_kind_kbns.id');
        $query->when($slipKindKbnCd, fn($query) => $query->where('slip_kind_kbn_cd', $slipKindKbnCd));
        $query->when($slipKindCd, fn($query) => $query->where('slip_kind_cd', $slipKindCd));

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 伝票種別情報取得 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtSlipKind::select('mt_slip_kinds.*', 'def_slip_kind_kbns.*')
            ->leftJoin('def_slip_kind_kbns', 'mt_slip_kinds.def_slip_kind_kbn_id', 'def_slip_kind_kbns.id')
            ->get();
        return $result;
    }

    /**
     * 伝票種別情報 存在確認(code指定)
     * @param $slip_kind_cd, $slip_kind_kbn_cd
     * @return Object
     */
    public function isExist($slip_kind_cd, $slip_kind_kbn_cd)
    {
        $result = MtSlipKind::leftjoin('def_slip_kind_kbns', 'mt_slip_kinds.def_slip_kind_kbn_id', 'def_slip_kind_kbns.id')
            ->where('slip_kind_kbn_cd', $slip_kind_kbn_cd)
            ->where('slip_kind_cd', $slip_kind_cd)
            ->exists();
        return $result;
    }

    /**
     * 伝票種別情報 名称補完(code指定)
     * @param $slipKindCd
     * @param $slipKindKbnCd
     * @return Object
     */
    public function getByCode($slipKindCd, $slipKindKbnCd)
    {
        $query = MtSlipKind::query();
        $query->leftjoin('def_slip_kind_kbns', 'mt_slip_kinds.def_slip_kind_kbn_id', 'def_slip_kind_kbns.id');
        $query->select('mt_slip_kinds.*');
        $query->where('slip_kind_kbn_cd', $slipKindKbnCd);
        $query->where('slip_kind_cd', $slipKindCd);

        return $query->first();
    }
}
