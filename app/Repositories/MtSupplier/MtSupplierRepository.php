<?php

namespace App\Repositories\MtSupplier;

use App\Models\MtSupplier;
use App\Models\MtPayDestination;
use App\Models\MtSupplierClass;
use App\Models\MtSlipKind;
use App\Models\MtUser;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use App\Repositories\MtPayDestination\MtPayDestinationRepository;
use App\Repositories\MtSlipKind\MtSlipKindRepository;
use App\Repositories\MtSupplierClass\MtSupplierClassRepository;
use App\Repositories\MtUser\MtUserRepository;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtSupplierRepository implements MtSupplierRepositoryInterface
{

    /**
     * 仕入先マスタ 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtSupplier::leftJoin('mt_pay_destinations', 'mt_suppliers.mt_pay_destination_id', 'mt_pay_destinations.id')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 仕入先マスタ 条件取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $code = $params['supplier_cd'] ? CodeUtil::pad($params['supplier_cd'], 6) : null;
        $name = $params['supplier_name'] ?? null;
        $kana = $params['supplier_name_kana'] ?? null;
        $tel = $params['tel'] ?? null;

        $query = MtSupplier::query();
        $query->leftJoin('mt_pay_destinations', 'mt_suppliers.mt_pay_destination_id', 'mt_pay_destinations.id');
        $query->when($code, fn($query) => $query->where("supplier_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("supplier_name", 'like', "%$name%"));
        $query->when($kana, fn($query) => $query->where("supplier_name_kana", 'like', "%$kana%"));
        $query->when($tel, fn($query) => $query->where("tel", 'like', "%$tel%"));
        $query->orderBy('supplier_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    public function getById($id)
    {
        $query = MtSupplier::query();
        $query->select(
            'mt_suppliers.*',
            'mt_pay_destinations.pay_destination_cd',
            'mt_pay_destinations.sequentially_kbn',
            'mt_pay_destinations.closing_date',
            'mt_pay_destinations.closing_month',
            'mt_pay_destinations.pay_date',
            'mt_pay_destinations.price_fraction_process',
            'mt_pay_destinations.all_amount_fraction_process',
            'mt_pay_destinations.tax_kbn',
            'mt_pay_destinations.tax_calculation_standard',
            'mt_pay_destinations.tax_fraction_process_1',
            'mt_pay_destinations.tax_fraction_process_2',
            'mt_pay_destinations.mt_user_last_update_id',
        );
        $query->leftJoin('mt_pay_destinations', 'mt_suppliers.mt_pay_destination_id', 'mt_pay_destinations.id');
        return $query->find($id);
    }

    /**
     * 仕入先マスタ ID指定
     * @param $id
     * @return Object
     */
    public function getDetailById($id)
    {
        $result = MtSupplier::select(
            'mt_suppliers.id',
            'mt_suppliers.*',
            'mt_pay_destinations.pay_destination_cd',
            'mt_pay_destinations.sequentially_kbn',
            'mt_pay_destinations.closing_date',
            'mt_pay_destinations.closing_month',
            'mt_pay_destinations.pay_date',
            'mt_pay_destinations.price_fraction_process',
            'mt_pay_destinations.all_amount_fraction_process',
            'mt_pay_destinations.tax_kbn',
            'mt_pay_destinations.tax_calculation_standard',
            'mt_pay_destinations.tax_fraction_process_1',
            'mt_pay_destinations.tax_fraction_process_2',
            'ms1.def_supplier_class_thing_id as ms1_def_supplier_class_thing_id',
            'ms1.supplier_class_cd as ms1_supplier_class_cd',
            'ms1.supplier_class_name as ms1_supplier_class_name',
            'ms2.def_supplier_class_thing_id as ms2_def_supplier_class_thing_id',
            'ms2.supplier_class_cd as ms2_supplier_class_cd',
            'ms2.supplier_class_name as ms2_supplier_class_name',
            'ms3.def_supplier_class_thing_id as ms3_def_supplier_class_thing_id',
            'ms3.supplier_class_cd as ms3_supplier_class_cd',
            'ms3.supplier_class_name as ms3_supplier_class_name',
            'mt_slip_kinds.def_slip_kind_kbn_id',
            'mt_slip_kinds.slip_kind_cd',
            'mt_slip_kinds.slip_kind_name',
            'mt_users.user_cd',
            'mt_users.user_name',
        )
            ->leftJoin('mt_pay_destinations', 'mt_suppliers.mt_pay_destination_id', 'mt_pay_destinations.id')
            ->leftJoin('mt_supplier_classes as ms1', 'mt_suppliers.mt_supplier_class1_id', 'ms1.id')
            ->leftJoin('mt_supplier_classes as ms2', 'mt_suppliers.mt_supplier_class2_id', 'ms2.id')
            ->leftJoin('mt_supplier_classes as ms3', 'mt_suppliers.mt_supplier_class3_id', 'ms3.id')
            ->leftJoin('mt_slip_kinds', 'mt_suppliers.mt_slip_kind_order_id', 'mt_slip_kinds.id')
            ->leftJoin('mt_users', 'mt_suppliers.mt_user_id', 'mt_users.id')
            ->where('mt_suppliers.id', $id)->first();
        return $result;
    }

    /**
     * 仕入先マスタ 更新
     * @param $params
     * @return Object
     */
    /*
    public function update($params) {
        $result = array();
        try {
            DB::beginTransaction();
            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_code'][$i])) {
                    $mtDeliveryDestination = new MtDeliveryDestination();
                    $mtDeliveryDestination->delivery_destination_id = $params['insert_code'][$i];
                    $mtDeliveryDestination->delivery_destination_name = $params['insert_name'][$i];
                    $mtDeliveryDestination->del_kbn_delivery_destination = $params['insert_flg'][$i];
                    $mtDeliveryDestination->mt_user_register_id = Auth::user()->id;
                    $mtDeliveryDestination->mt_user_last_update_id = Auth::user()->id;
                    $mtDeliveryDestination->save();
                }
                $i++;
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }
    ＊/

    /**
     * 仕入先マスタ(詳細) 更新
     * updateの中でcreateしている修正推奨（その他のRepositoryも全体的に）
     * serviceの役割をしている修正推奨
     * @param $params
     * @return Object
     */
    public function update($param)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $mtPayDestination = MtPayDestination::where('pay_destination_cd', $param['pay_destination_cd'])->first();
            $mtSupplier = $param['update_id'] ? MtSupplier::with('mtPayDestination')->find($param['update_id']) : null;

            // 支払先マスタ
            // (バリデーションではじかれ到達しないパターンは考慮しない：仕入先⇒既存/支払先⇒新規、仕入先⇒既存/支払先⇒既存（変更）)
            if (is_null($mtPayDestination)) {
                // 仕入先：新規、支払先：新規⇒作成
                $mtPayDestination = (new MtPayDestinationRepository)->create($param);
            } else {
                if (!is_null($mtSupplier)) {
                    // 仕入先：既存、支払先：既存⇒コード一致変更可、不一致変更不可
                    if ($mtSupplier->mtPayDestination->pay_destination_cd == $mtPayDestination->pay_destination_cd) {
                        $mtPayDestination = (new MtPayDestinationRepository)->update($param, $mtPayDestination);
                    }
                }
                // 仕入先：新規、支払先：既存⇒参照付与なので何もしない
            }

            //仕入先マスタ
            if (is_null($mtSupplier)) {
                $mtSupplier = new MtSupplier();
                $mtSupplier->supplier_cd = $param['supplier_cd'];
            }
            $mtSupplier = $this->setProperties($param, $mtSupplier, $mtPayDestination);
            $mtSupplier->save();

            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtSupplierId'] = $mtSupplier['id'];
            $result['mtPayDestinationId'] = $mtPayDestination['id'];
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }

        return $result;
    }

    // modelにパラメータを丸ごと渡せるので本来こんなことする必要ない
    private function setProperties($param, $mtSupplier, $mtPayDestination)
    {
        $mtSupplierClassRepository = new MtSupplierClassRepository();
        $mtSlipKindRepository = new MtSlipKindRepository();
        $userRepository = new MtUserRepository();

        $mtSupplier->mt_pay_destination_id = $mtPayDestination['id'];
        $mtSupplier->mt_user_id = $userRepository->getByCode($param)?->id;
        $mtSupplier->supplier_name = $param['supplier_name'];
        $mtSupplier->supplier_name_kana = $param['supplier_name_kana'];
        $mtSupplier->honorific_kbn = $param['honorific_kbn'];
        $mtSupplier->post_number = $param['post_number'];
        $mtSupplier->address = $param['address'];
        $mtSupplier->tel = $param['tel'];
        $mtSupplier->fax = $param['fax'];
        $mtSupplier->representative_name = $param['representative_name'];
        $mtSupplier->representative_mail = $param['representative_mail'];
        $mtSupplier->supplier_manager_name = $param['supplier_manager_name'];
        $mtSupplier->supplier_manager_mail = $param['supplier_manager_mail'];
        $mtSupplier->supplier_url = $param['supplier_url'];
        $mtSupplier->mt_supplier_class1_id = $mtSupplierClassRepository->getByCode($param['mt_supplier_class1_cd'], 1)?->id;
        $mtSupplier->mt_supplier_class2_id = $mtSupplierClassRepository->getByCode($param['mt_supplier_class2_cd'], 2)?->id;
        $mtSupplier->mt_supplier_class3_id = $mtSupplierClassRepository->getByCode($param['mt_supplier_class3_cd'], 3)?->id;
        $mtSupplier->name_input_kbn = $param['name_input_kbn'];
        $mtSupplier->del_kbn = $param['del_kbn'];
        $mtSupplier->mt_slip_kind_order_id = $mtSlipKindRepository->getByCode($param['mt_slip_kind_order_cd'], '04')?->id;
        $mtSupplier->supplier_memo_1 = $param['supplier_memo_1'];
        $mtSupplier->supplier_memo_2 = $param['supplier_memo_2'];
        $mtSupplier->supplier_memo_3 = $param['supplier_memo_3'];
        $mtSupplier->supplier_expansion_1 = $param['supplier_expansion_1'];
        $mtSupplier->supplier_expansion_2 = $param['supplier_expansion_2'];
        $mtSupplier->supplier_expansion_3 = $param['supplier_expansion_3'];
        $mtSupplier->supplier_expansion_4 = $param['supplier_expansion_4'];
        $mtSupplier->supplier_expansion_5 = $param['supplier_expansion_5'];
        $mtSupplier->mt_user_last_update_id = Auth::user()->id;
        return $mtSupplier;
    }

    /**
     * 仕入先マスタを削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $supplier = MtSupplier::find($id);
            // $payDestination = MtPayDestination::find($supplier->mt_pay_destination_id);
            $payDestination = MtPayDestination::where('pay_destination_cd', $supplier->supplier_cd);
            $supplier->delete();
            $payDestination->delete();
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
     * 仕入先リスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 6, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';
        $result = MtSupplier::select(
            'mt_suppliers.*',
            'mt_pay_destinations.*',
            'mt_users.*',
            'mt_slip_kinds.*',
            'msc1.supplier_class_cd as supplier_class_cd1',
            'msc1.supplier_class_name as supplier_class_name1',
            'msc2.supplier_class_cd as supplier_class_cd2',
            'msc2.supplier_class_name as supplier_class_name2',
            'msc3.supplier_class_cd as supplier_class_cd3',
            'msc3.supplier_class_name as supplier_class_name3',
        )
            ->leftJoin("mt_pay_destinations", "mt_suppliers.mt_pay_destination_id", "mt_pay_destinations.id")
            ->leftJoin("mt_slip_kinds", "mt_suppliers.mt_slip_kind_order_id", "mt_slip_kinds.id")
            ->leftJoin("mt_supplier_classes as msc1", "mt_suppliers.mt_supplier_class1_id", "msc1.id")
            ->leftJoin("mt_supplier_classes as msc2", "mt_suppliers.mt_supplier_class2_id", "msc2.id")
            ->leftJoin("mt_supplier_classes as msc3", "mt_suppliers.mt_supplier_class3_id", "msc3.id")
            ->leftJoin("mt_users", "mt_suppliers.mt_user_id", "mt_users.id")
            ->whereBetween("mt_suppliers.supplier_cd", [$startCode, $endCode])
            ->orderBy("mt_suppliers.supplier_cd")
            ->get();
        return $result;
    }


    /**
     *仕入先 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['supplier_cd'] ? CodeUtil::pad($params['supplier_cd'], 6) : null;

        $query = MtSupplier::query();
        $query->select(
            'mt_suppliers.*',
            'mt_pay_destinations.pay_destination_cd',
            'mt_pay_destinations.sequentially_kbn',
            'mt_pay_destinations.closing_date',
            'mt_pay_destinations.closing_month',
            'mt_pay_destinations.pay_date',
            'mt_pay_destinations.price_fraction_process',
            'mt_pay_destinations.all_amount_fraction_process',
            'mt_pay_destinations.tax_kbn',
            'mt_pay_destinations.tax_calculation_standard',
            'mt_pay_destinations.tax_fraction_process_1',
            'mt_pay_destinations.tax_fraction_process_2',
            'mt_pay_destinations.mt_user_last_update_id',
        );
        $query->leftJoin('mt_pay_destinations', 'mt_suppliers.mt_pay_destination_id', 'mt_pay_destinations.id');
        $query->where('supplier_cd', $code);
        return $query->first();
    }

    /**
     * 仕入先の最小ID取得
     * @return Object
     */
    public function getMinId()
    {
        $code = MtSupplier::min('supplier_cd');
        $result = MtSupplier::where('supplier_cd', $code)->first();
        return $result['supplier_cd'];
    }

    /**
     * 仕入先の最大ID取得
     * @return Object
     */
    public function getMaxId()
    {
        $code = MtSupplier::max('supplier_cd');
        $result = MtSupplier::where('supplier_cd', $code)->first();
        return $result['supplier_cd'];
    }

    /**
     * 仕入先　前頁
     * @param $id
     * @return Object
     */
    public function getPrevById($id)
    {
        if (isset($id)) {
            $code = MtSupplier::where('id', $id)->first();
            $result = MtSupplier::where('supplier_cd', '<', $code['supplier_cd'])->orderByDesc('supplier_cd')->first();
        }
        return $result;
    }

    /**
     * 仕入先　次頁
     * @param $id
     * @return Object
     */
    public function getNextById($id)
    {
        if (isset($id)) {
            $code = MtSupplier::where('id', $id)->first();
            $result = MtSupplier::where('supplier_cd', '>', $code['supplier_cd'])->orderBy('supplier_cd')->first();
        } else {
            $result = MtSupplier::orderBy('supplier_cd')->first();
        }
        return $result;
    }
}
