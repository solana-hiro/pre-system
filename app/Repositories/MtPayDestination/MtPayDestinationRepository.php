<?php

namespace App\Repositories\MtPayDestination;

use App\Models\MtPayDestination;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class MtPayDestinationRepository implements MtPayDestinationRepositoryInterface
{

    /**
     * 支払先情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtPayDestination::get();
        return $result;
    }

    /**
     * 支払先情報取得 指定条件にて取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $code = $params['code'] ? CodeUtil::pad($params['code'], 6) : null;
        $name = $params['name'] ?? null;
        $kana = $params['kana'] ?? null;
        $tel = $params['tel'] ?? null;

        $query = MtPayDestination::query();
        $query->join('mt_suppliers', 'mt_suppliers.supplier_cd', 'mt_pay_destinations.pay_destination_cd');
        $query->when($code, fn($query) => $query->where("supplier_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("supplier_name", 'like', "%$name%"));
        $query->when($kana, fn($query) => $query->where("supplier_name_kana", 'like', "%$kana%"));
        $query->when($tel, fn($query) => $query->where("tel", 'like', "%$tel%"));
        $query->orderBy('pay_destination_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 支払先マスタ 登録
     * @param $params
     * @return Object
     */
    public function create($param)
    {
        $mtPayDestination = new MtPayDestination();
        $mtPayDestination->pay_destination_cd = $param['pay_destination_cd'];
        $mtPayDestination = $this->setProperties($param, $mtPayDestination);
        $mtPayDestination->save();
        return $mtPayDestination;
    }

    /**
     * 支払先マスタ 更新
     * @param $params, $mtPayDestination
     * @return Object
     */
    public function update($param, $mtPayDestination)
    {
        $mtPayDestination = $this->setProperties($param, $mtPayDestination);
        $mtPayDestination->save();
        return $mtPayDestination;
    }

    private function setProperties($param, $mtPayDestination)
    {
        $mtPayDestination->sequentially_kbn = $param['sequentially_kbn'];
        if (isset($param['closing_date'])) $mtPayDestination->closing_date = $param['closing_date'];
        if (isset($param['closing_month'])) $mtPayDestination->closing_month = $param['closing_month'];
        if (isset($param['pay_date'])) $mtPayDestination->pay_date = $param['pay_date'];
        $mtPayDestination->price_fraction_process = $param['price_fraction_process'];
        $mtPayDestination->all_amount_fraction_process = $param['all_amount_fraction_process'];
        $mtPayDestination->tax_kbn = $param['tax_kbn'];
        $mtPayDestination->tax_calculation_standard = $param['tax_calculation_standard'];
        $mtPayDestination->tax_fraction_process_1 = $param['tax_fraction_process_1'];
        $mtPayDestination->tax_fraction_process_2 = $param['tax_fraction_process_2'];
        $mtPayDestination->mt_user_last_update_id = Auth::user()->id;
        return $mtPayDestination;
    }

    /**
     * 情報リスト  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = isset($params['code_start']) ? str_pad($params['code_start'], 6, 0, STR_PAD_LEFT) : '';
        $endCode = isset($params['code_end']) ? str_pad($params['code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';
        $result = MtPayDestination::whereBetween("bank_cd", [$startCode, $endCode])
            ->orderBy("id")
            ->get();
        return $result;
    }

    /**
     * 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['pay_destination_cd'] ? CodeUtil::pad($params['pay_destination_cd'], 6) : null;
        $query = MtPayDestination::query();

        $query->leftjoin('mt_suppliers', function ($join) {
            $join
                ->on('mt_suppliers.mt_pay_destination_id', '=', 'mt_pay_destinations.id')
                ->on('mt_suppliers.supplier_cd', '=', 'mt_pay_destinations.pay_destination_cd');
        });
        $query->select(
            'mt_pay_destinations.*',
            'mt_suppliers.supplier_cd',
            'mt_suppliers.mt_pay_destination_id',
            'mt_suppliers.supplier_name',
            'mt_suppliers.supplier_name_kana',
            'mt_suppliers.honorific_kbn',
            'mt_suppliers.post_number',
            'mt_suppliers.address',
            'mt_suppliers.tel',
            'mt_suppliers.fax',
            'mt_suppliers.mt_supplier_class1_id',
            'mt_suppliers.mt_supplier_class2_id',
            'mt_suppliers.mt_supplier_class3_id',
            'mt_suppliers.representative_name',
            'mt_suppliers.representative_mail',
            'mt_suppliers.supplier_manager_name',
            'mt_suppliers.supplier_manager_mail',
            'mt_suppliers.supplier_url',
            'mt_suppliers.mt_user_id',
            'mt_suppliers.name_input_kbn',
            'mt_suppliers.del_kbn',
            'mt_suppliers.mt_slip_kind_order_id',
            'mt_suppliers.supplier_memo_1',
            'mt_suppliers.supplier_memo_2',
            'mt_suppliers.supplier_memo_3',
            'mt_suppliers.supplier_expansion_1',
            'mt_suppliers.supplier_expansion_2',
            'mt_suppliers.supplier_expansion_3',
            'mt_suppliers.supplier_expansion_4',
            'mt_suppliers.supplier_expansion_5',
            'mt_suppliers.data_decision_date',
            'mt_suppliers.mt_user_last_update_id',
        );
        $query->where('pay_destination_cd', $code);

        return $query->first();
    }
}
