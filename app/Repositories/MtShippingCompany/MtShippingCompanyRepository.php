<?php

namespace App\Repositories\MtShippingCompany;

use App\Models\MtShippingCompany;
use App\Models\MtSlipKind;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use App\Repositories\MtSlipKind\MtSlipKindRepository;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtShippingCompanyRepository implements MtShippingCompanyRepositoryInterface
{

    /**
     * 運送会社情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtShippingCompany::paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 運送会社情報  初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtShippingCompany::select(
            'mt_shipping_companies.id as id',
            'mt_shipping_companies.shipping_company_cd as shipping_company_cd',
            'mt_shipping_companies.shipping_company_name as shipping_company_name',
            'msk1.slip_kind_cd as slip_kind_7_cd',
            'msk2.slip_kind_cd as slip_kind_17_cd',
            'msk1.slip_kind_name as slip_kind_7_name',
            'msk2.slip_kind_name as slip_kind_17_name',
        )
            ->leftJoin("mt_slip_kinds as msk1", "mt_shipping_companies.mt_slip_kind7_id", "msk1.id")
            ->leftJoin("mt_slip_kinds as msk2", "mt_shipping_companies.mt_slip_kind17_id", "msk2.id")
            ->orderBy("mt_shipping_companies.shipping_company_cd")
            ->get();
        return $result;
    }

    /**
     * 運送会社情報 更新
     * @param $param
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            foreach ($params['update_shipping_company_code'] as $index => $code) {
                $this->updateShippingCompany($params, $index, $code);
            };
            // 新規
            foreach ($params['insert_shipping_company_code'] as $index => $code) {
                $this->createShippingCompany($params, $index, $code);
            };
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    private function createShippingCompany($params, $index, $code)
    {
        if (empty($code)) return;
        $mtShippingCompany = new MtShippingCompany();
        $mtShippingCompany->shipping_company_cd = $params['insert_shipping_company_code'][$index];
        $mtShippingCompany = $this->setProperties($params, $index, $mtShippingCompany, 'insert');
        $mtShippingCompany->save();
    }

    private function updateShippingCompany($params, $index, $code)
    {
        if (empty($code)) return;
        $mtShippingCompany = MtShippingCompany::find($params['update_id'][$index]);
        $mtShippingCompany = $this->setProperties($params, $index, $mtShippingCompany, 'update');
        $mtShippingCompany->save();
    }

    private function setProperties($params, $index, $mtShippingCompany, $type)
    {
        $mtSlipKindRepository = new MtSlipKindRepository();
        $mtShippingCompany->shipping_company_name = $params["{$type}_shipping_company_name"][$index];
        $mtShippingCompany->mt_slip_kind7_id = $mtSlipKindRepository->getByCode($params["{$type}_slip_kind7"][$index], '07')?->id;
        $mtShippingCompany->mt_slip_kind17_id = $mtSlipKindRepository->getByCode($params["{$type}_slip_kind17"][$index], '17')?->id;
        $mtShippingCompany->mt_user_last_update_id = Auth::user()->id;

        return $mtShippingCompany;
    }

    /**
     * 運送会社情報 削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtShippingCompany::where('id', $id)->delete();
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 運送会社情報 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['shipping_company_cd'] ? CodeUtil::pad($params['shipping_company_cd'], 4) : null;
        $name = $params['shipping_company_name'] ?? null;

        $query = MtShippingCompany::query();
        $query->when($code, fn($query) => $query->where("shipping_company_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("shipping_company_name", 'like', "%$name%"));
        $query->orderBy('shipping_company_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 運送会社リスト  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 4, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ';
        $result = MtShippingCompany::select(
            'mt_shipping_companies.shipping_company_cd as shipping_company_cd',
            'mt_shipping_companies.shipping_company_name as shipping_company_name',
            'msk1.slip_kind_cd as slip_kind_7_cd',
            'msk2.slip_kind_cd as slip_kind_17_cd',
        )
            ->leftJoin("mt_slip_kinds as msk1", "mt_shipping_companies.mt_slip_kind7_id", "msk1.id")
            ->leftJoin("mt_slip_kinds as msk2", "mt_shipping_companies.mt_slip_kind17_id", "msk2.id")
            ->whereBetween("mt_shipping_companies.shipping_company_cd", [$startCode, $endCode])
            ->orderBy("mt_shipping_companies.shipping_company_cd")
            ->get();
        return $result;
    }

    /**
     * 運送会社 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['shipping_company_cd'] ? CodeUtil::pad($params['shipping_company_cd'], 4) : null;

        $query = MtShippingCompany::query();
        $query->select(
            'mt_shipping_companies.shipping_company_cd as shipping_company_cd',
            'mt_shipping_companies.shipping_company_name as shipping_company_name',
            'msk1.slip_kind_cd as slip_kind_7_cd',
            'msk2.slip_kind_cd as slip_kind_17_cd',
        );
        $query->where('shipping_company_cd', $code);
        $query->leftJoin("mt_slip_kinds as msk1", "mt_shipping_companies.mt_slip_kind7_id", "msk1.id");
        $query->leftJoin("mt_slip_kinds as msk2", "mt_shipping_companies.mt_slip_kind17_id", "msk2.id");

        return $query->first();
    }
}
