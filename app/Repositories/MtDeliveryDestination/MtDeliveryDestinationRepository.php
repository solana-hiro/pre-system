<?php

namespace App\Repositories\MtDeliveryDestination;

use App\Models\MtDeliveryDestination;
use App\Models\MtCustomerDeliveryDestination;
use App\Models\DefArrivalDate;
use App\Models\MtRoot;
use App\Models\MtCustomer;
use App\Models\MtItemClass;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use App\Models\Numbering;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtDeliveryDestinationRepository implements MtDeliveryDestinationRepositoryInterface
{

    /**
     * 納品先マスタ 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtCustomerDeliveryDestination::select(
            'mt_customer_delivery_destinations.id as id',
            'mt_customers.customer_cd as customer_cd',
            'mt_customers.customer_name as customer_name',
            'mt_delivery_destinations.delivery_destination_id as delivery_destination_id',
            'mt_delivery_destinations.delivery_destination_name as delivery_destination_name',
            'mt_delivery_destinations.delivery_destination_name_kana as delivery_destination_name_kana',
            'mt_delivery_destinations.tel as tel'
        )
            ->leftJoin('mt_customers', 'mt_customer_delivery_destinations.mt_customer_id', 'mt_customers.id')
            ->leftJoin('mt_delivery_destinations', 'mt_customer_delivery_destinations.mt_delivery_destination_id', 'mt_delivery_destinations.id')
            ->orderBy('customer_cd')->orderBy('delivery_destination_id')
            ->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 納品先マスタ 初期データ取得
     * @param $params
     * @return Object
     */
    public function getInitData($params)
    {
        // initじゃないので名前変えたほうがわかりやすい
        $query = MtDeliveryDestination::select(
            'id',
            'delivery_destination_id',
            'delivery_destination_name',
            'del_kbn_delivery_destination'
        );
        if (isset($params['delivery_destination_id'])) {
            $query = $query->where('delivery_destination_id', '>=', str_pad($params['delivery_destination_id'], 6, 0, STR_PAD_LEFT));
        }
        return $query->orderBy('delivery_destination_id')->paginate(CommonConsts::LIST_PAGINATION);
    }

    /**
     * 納品先マスタ 条件取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $cCode = $params['customer_cd'] ? CodeUtil::pad($params['customer_cd'], 6) : null;
        $dCode = $params['delivery_destination_cd'] ? CodeUtil::pad($params['delivery_destination_cd'], 6) : null;
        $name = $params['delivery_destination_name'] ?? null;
        $kana = $params['delivery_destination_name_kana'] ?? null;
        $tel = $params['tel'] ?? null;

        $query = MtCustomerDeliveryDestination::query();
        $query->select(
            'mt_customer_delivery_destinations.id as id',
            'mt_customers.customer_cd as customer_cd',
            'mt_customers.customer_name as customer_name',
            'mt_delivery_destinations.delivery_destination_id as delivery_destination_id',
            'mt_delivery_destinations.delivery_destination_name as delivery_destination_name',
            'mt_delivery_destinations.delivery_destination_name_kana as delivery_destination_name_kana',
            'mt_delivery_destinations.tel as tel'
        );
        $query->leftJoin('mt_customers', 'mt_customer_delivery_destinations.mt_customer_id', 'mt_customers.id');
        $query->leftJoin('mt_delivery_destinations', 'mt_customer_delivery_destinations.mt_delivery_destination_id', 'mt_delivery_destinations.id');
        $query->when($cCode, fn($query) => $query->where("mt_customers.customer_cd", '>=', $cCode));
        $query->when($dCode, fn($query) => $query->where("mt_delivery_destinations.delivery_destination_id", '>=', $dCode));
        $query->when($name, fn($query) => $query->where("mt_delivery_destinations.delivery_destination_name", 'like', "%$name%"));
        $query->when($kana, fn($query) => $query->where("mt_delivery_destinations.delivery_destination_name_kana", 'like', "%$kana%"));
        $query->when($tel, fn($query) => $query->where("mt_delivery_destinations.tel", 'like', "%$tel%"));
        $query->orderBy('mt_customers.customer_cd')->orderBy('delivery_destination_id');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 納品先マスタ 取得(id指定)
     * @param $id
     * @return Object
     */
    public function getDetailById($id, $customer_id = null)
    {
        $result['mtDeliveryDestination'] = MtDeliveryDestination::where('id', $id)->first();
        $query = MtCustomerDeliveryDestination::select(
            'mt_customer_delivery_destinations.id as id',
            'mt_customer_delivery_destinations.*',
            'mt_roots.root_cd',
            'mt_roots.root_name',
            'mt_item_classes.item_class_cd',
            'mt_item_classes.item_class_name',
            'def_arrival_dates.arrival_date_cd',
            'def_arrival_dates.arrival_date_name',
            'mt_customers.customer_cd',
            'mt_customers.customer_name',
        )
            ->leftJoin('mt_roots', 'mt_customer_delivery_destinations.mt_root_id', 'mt_roots.id')
            ->leftJoin('mt_item_classes', 'mt_customer_delivery_destinations.mt_item_class_shipping_companie_id', 'mt_item_classes.id')
            ->leftJoin('def_arrival_dates', 'mt_customer_delivery_destinations.def_arrival_date_id', 'def_arrival_dates.id')
            ->leftJoin('mt_customers', 'mt_customer_delivery_destinations.mt_customer_id', 'mt_customers.id');
        if ($customer_id) {
            $query = $query->where('mt_customer_delivery_destinations.mt_delivery_destination_id', $result['mtDeliveryDestination']['id'])
                ->where('mt_customer_delivery_destinations.mt_customer_id', $customer_id);
        } else {
            $query = $query->where('mt_customer_delivery_destinations.mt_delivery_destination_id', $result['mtDeliveryDestination']['id']);
        }

        $result['mtCustomerDeliveryDestination'] = $query->orderByDesc('updated_at')->first();
        $result['defArrivalDate'] = DefArrivalDate::get();
        $result['mtRoot'] = MtRoot::get();
        //$result['mtCustomerDeliveryDestination'] = MtCustomerDeliveryDestination::where('mt_delivery_destination_id', $id);
        return $result;
    }

    /**
     * 納品先マスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            //新規登録
            $i = 0;
            $save_count = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_code'][$i])) {
                    $mtDeliveryDestination = new MtDeliveryDestination();
                    $mtDeliveryDestination->delivery_destination_id = $params['insert_code'][$i];
                    $mtDeliveryDestination->delivery_destination_name = $params['insert_name'][$i];
                    $mtDeliveryDestination->del_kbn_delivery_destination = $params['insert_flg'][$i];
                    $mtDeliveryDestination->mt_user_register_id = Auth::user()->id;
                    $mtDeliveryDestination->mt_user_last_update_id = Auth::user()->id;
                    $mtDeliveryDestination->save();
                    $save_count++;
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

    /**
     * 納品先マスタ(詳細) 更新
     * @param $params
     * @return Object
     */
    public function updateDetail($param)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $is_new = 0;
            //納品先マスタ
            if ($param['hidden_detail_id'] && !empty(MtDeliveryDestination::where('id', $param['hidden_detail_id'])->first())) {
                //更新
                $mtDeliveryDestination = MtDeliveryDestination::where('id', $param['hidden_detail_id'])->first();
                //$mtDeliveryDestination->delivery_destination_id = $param['delivery_destination_cd'];
                $mtDeliveryDestination->delivery_destination_name = $param['delivery_destination_name'];
                $mtDeliveryDestination->delivery_destination_name_kana = $param['delivery_destination_name_kana'];
                $mtDeliveryDestination->honorific_kbn = $param['honorific_kbn'];
                $mtDeliveryDestination->post_number = $param['post_number'];
                $mtDeliveryDestination->address = $param['address'];
                $mtDeliveryDestination->tel = $param['tel'];
                $mtDeliveryDestination->fax = $param['fax'];
                $mtDeliveryDestination->representative_name = $param['representative_name'];
                $mtDeliveryDestination->representative_mail = $param['representative_mail'];
                $mtDeliveryDestination->delivery_destination_manager_name = $param['delivery_destination_manager_name'];
                $mtDeliveryDestination->delivery_destination_manager_mail = $param['delivery_destination_manager_mail'];
                $mtDeliveryDestination->delivery_destination_url = $param['delivery_destination_url'];
                if (isset($param['delivery_price']) && '' != $param['delivery_price']) {
                    $mtDeliveryDestination->delivery_price = str_replace(',', '', $param['delivery_price']);
                } else {
                    $mtDeliveryDestination->delivery_price = null;
                }
                $mtDeliveryDestination->name_input_kbn = $param['name_input_kbn'];
                $mtDeliveryDestination->del_kbn_delivery_destination = $param['del_kbn_delivery_destination'];
                //$mtDeliveryDestination->mt_user_register_id = Auth::user()->id;
                $mtDeliveryDestination->mt_user_last_update_id = Auth::user()->id;
                $mtDeliveryDestination->save();
            } else {
                //新規登録
                $is_new = 1;
                $mtDeliveryDestination = new MtDeliveryDestination();
                // $mtDeliveryDestination->delivery_destination_id = $param['delivery_destination_cd'];
                $mtDeliveryDestination->delivery_destination_id = $this->getNextDeliveryDestinationId();
                $mtDeliveryDestination->delivery_destination_name = $param['delivery_destination_name'];
                $mtDeliveryDestination->delivery_destination_name_kana = $param['delivery_destination_name_kana'];
                $mtDeliveryDestination->honorific_kbn = $param['honorific_kbn'];
                $mtDeliveryDestination->post_number = $param['post_number'];
                $mtDeliveryDestination->address = $param['address'];
                $mtDeliveryDestination->tel = $param['tel'];
                $mtDeliveryDestination->fax = $param['fax'];
                $mtDeliveryDestination->representative_name = $param['representative_name'];
                $mtDeliveryDestination->representative_mail = $param['representative_mail'];
                $mtDeliveryDestination->delivery_destination_manager_name = $param['delivery_destination_manager_name'];
                $mtDeliveryDestination->delivery_destination_manager_mail = $param['delivery_destination_manager_mail'];
                $mtDeliveryDestination->delivery_destination_url = $param['delivery_destination_url'];
                if (isset($param['delivery_price']) && '' != $param['delivery_price']) {
                    $mtDeliveryDestination->delivery_price = str_replace(',', '', $param['delivery_price']);
                } else {
                    $mtDeliveryDestination->delivery_price = null;
                }
                $mtDeliveryDestination->name_input_kbn = $param['name_input_kbn'];
                $mtDeliveryDestination->del_kbn_delivery_destination = $param['del_kbn_delivery_destination'];
                $mtDeliveryDestination->mt_user_register_id = Auth::user()->id;
                $mtDeliveryDestination->mt_user_last_update_id = Auth::user()->id;
                $mtDeliveryDestination->save();

                $numbering = Numbering::first();
                $numbering->now_delivery_destination_id = $param['delivery_destination_cd'];
                $numbering->save();
            }

            //得意先納品別マスタ 納品先と得意先の組み合わせ　存在確認
            $mtDeliveryDestinationId = $mtDeliveryDestination['id'];
            $mtCustomer = MtCustomer::where('customer_cd', $param['customer_cd'])->first();
            $mtCustomerDeliveryDestination = new MtCustomerDeliveryDestination();
            if (!empty($mtCustomer)) {
                $mtCustomerDeliveryDestination = MtCustomerDeliveryDestination::where('mt_customer_id', $mtCustomer['id'])->where('mt_delivery_destination_id', $mtDeliveryDestinationId)->first();
                if (empty($mtCustomerDeliveryDestination)) {
                    $mtCustomerDeliveryDestination = new MtCustomerDeliveryDestination();
                }
            } else {
                DB::rollback();
                $result['status'] = CommonConsts::STATUS_ERROR;
                $result['error'] = '該当の得意先コードが存在しません';
                return $result;
            }

            //得意先納品別マスタ mt_customer_delivery_destinations
            $mtCustomerDeliveryDestination->mt_customer_id = $mtCustomer['id'];
            $mtCustomerDeliveryDestination->mt_delivery_destination_id = $mtDeliveryDestinationId;
            $mtCustomerDeliveryDestination->del_kbn_customer = $param['del_kbn_customer'];
            $mtCustomerDeliveryDestination->sale_decision_print_paper_flg =  $param['sale_decision_print_paper_flg'];
            $defArrivalDate = DefArrivalDate::where('arrival_date_cd', $param['def_arrival_date_cd'])->first();
            if (!empty($defArrivalDate)) {
                $mtCustomerDeliveryDestination->def_arrival_date_id = $defArrivalDate['id'];
            }
            $mtCustomerDeliveryDestination->direct_delivery_commission_demand_flg = $param['direct_delivery_commission_demand_flg'];
            $mtRoot = MtRoot::where('root_cd', $param['mt_root_cd'])->first();
            if (!empty($mtRoot)) {
                $mtCustomerDeliveryDestination->mt_root_id = $mtRoot['id'];
            }
            $mtItemClass = MtItemClass::where('def_item_class_thing_id', 1)->where('item_class_cd', $param['mt_item_class1_cd'])->first();
            if (!empty($mtItemClass)) {
                $mtCustomerDeliveryDestination->mt_item_class_shipping_companie_id = $mtItemClass['id'];
            }
            $mtCustomerDeliveryDestination->delivery_destination_memo_1 = $param['delivery_destination_memo_1'];
            $mtCustomerDeliveryDestination->delivery_destination_memo_2 = $param['delivery_destination_memo_2'];
            $mtCustomerDeliveryDestination->delivery_destination_memo_3 = $param['delivery_destination_memo_3'];
            $mtCustomerDeliveryDestination->register_kind_flg = $param['register_kind_flg'];
            $mtCustomerDeliveryDestination->mt_user_last_update_id = Auth::user()->id;
            $mtCustomerDeliveryDestination->save();

            DB::commit();
            if ($is_new == 1) {
                $result['is_new'] = 1;
            } else {
                $result['is_new'] = 0;
            }
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtDeliveryDestinationId'] = $mtDeliveryDestination['id'];
            $result['mtDeliveryDestinationCode'] = $mtDeliveryDestination['delivery_destination_id'];
            $result['mtCustomerDeliveryDestinationId'] = $mtCustomerDeliveryDestination['id'];
            $result['mtCustomerId'] = $mtCustomer['id'];
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 納品先マスタを削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'][0] = MtCustomerDeliveryDestination::where('mt_delivery_destination_id', $id)->delete();
            $result['data'][1] = MtDeliveryDestination::where('id', $id)->delete();
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
     * 最小ID取得 (最小codeのID)
     * @return Object
     */
    public function getMinId()
    {
        $result = MtDeliveryDestination::orderBy('delivery_destination_id')->first();
        return $result['id'];
    }

    /**
     * 最大ID取得(最大codeのID)
     * @return Object
     */
    public function getMaxId()
    {
        $result = MtDeliveryDestination::orderByDesc('delivery_destination_id')->first();
        return $result['id'];
    }

    /**
     * 最小納品コード取得 (最小のcode)
     * @return Object
     */
    public function getMinCode()
    {
        $result = MtDeliveryDestination::orderBy('delivery_destination_id')->first();
        return $result['delivery_destination_id'];
    }

    /**
     * 最大納品コード取得(最大のcode)
     * @return Object
     */
    public function getMaxCode()
    {
        $result = MtDeliveryDestination::orderByDesc('delivery_destination_id')->first();
        return $result['delivery_destination_id'];
    }
    /**
     * 前頁
     * @param $id
     * @return Object
     */
    public function getPrevById($id)
    {
        if (isset($id)) {
            $code = MtDeliveryDestination::where('id', $id)->first();
            $result = MtDeliveryDestination::where('delivery_destination_id', '<', $code['delivery_destination_id'])->orderByDesc('delivery_destination_id')->first();
        }
        return $result;
    }

    /**
     * 次頁
     * @param $id
     * @return Object
     */
    public function getNextById($id)
    {
        if (isset($id)) {
            $code = MtDeliveryDestination::where('id', $id)->first();
            $result = MtDeliveryDestination::where('delivery_destination_id', '>', $code['delivery_destination_id'])->orderBy('delivery_destination_id')->first();
        } else {
            $result = MtDeliveryDestination::orderBy('delivery_destination_id')->first();
        }
        return $result;
    }


    /**
     * 納品先リスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 6, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';
        $deliveryDestinationIds = MtDeliveryDestination::whereBetween('delivery_destination_id', [$startCode, $endCode])->pluck('id');
        /*
        $result = MtCustomerDeliveryDestination::leftJoin("mt_delivery_destinations", "mt_customer_delivery_destinations.mt_delivery_destination_id", "mt_delivery_destinations.id")
            ->leftJoin("mt_customers", "mt_customer_delivery_destinations.mt_customer_id", "mt_customers.id")
            ->leftJoin("mt_roots", "mt_customer_delivery_destinations.mt_root_id", "mt_roots.id")
            ->leftJoin("mt_item_classes", "mt_customer_delivery_destinations.mt_item_class_shipping_companie_id", "mt_item_classes.id")
            ->leftJoin("def_arrival_dates", "mt_customer_delivery_destinations.def_arrival_date_id", "def_arrival_dates.id")
            ->whereIn("mt_delivery_destinations.id", $deliveryDestinationIds)
            ->orderBy("mt_delivery_destinations.delivery_destination_id")
            ->cursor();
        */
        $result = MtDeliveryDestination::select(
            'mt_delivery_destinations.*',
            'mt_customers.customer_cd',
            'mt_customers.customer_name',
            'mt_roots.root_cd',
            'mt_roots.root_name',
            'mt_item_classes.item_class_cd',
            'mt_item_classes.item_class_name',
            'def_arrival_dates.arrival_date_cd',
            'def_arrival_dates.arrival_date_name',
            'mt_customer_delivery_destinations.del_kbn_customer',
            'mt_customer_delivery_destinations.direct_delivery_commission_demand_flg',
            'mt_customer_delivery_destinations.sale_decision_print_paper_flg',
            'mt_customer_delivery_destinations.delivery_destination_memo_1',
            'mt_customer_delivery_destinations.delivery_destination_memo_2',
            'mt_customer_delivery_destinations.delivery_destination_memo_3',
            'mt_customer_delivery_destinations.register_kind_flg',
        )
            ->leftJoin("mt_customer_delivery_destinations", "mt_delivery_destinations.id", "mt_customer_delivery_destinations.mt_delivery_destination_id")
            ->leftJoin('mt_customers', 'mt_customer_delivery_destinations.mt_customer_id', 'mt_customers.id')
            ->leftJoin("mt_roots", "mt_customer_delivery_destinations.mt_root_id", "mt_roots.id")
            ->leftJoin("mt_item_classes", "mt_customer_delivery_destinations.mt_item_class_shipping_companie_id", "mt_item_classes.id")
            ->leftJoin("def_arrival_dates", "mt_customer_delivery_destinations.def_arrival_date_id", "def_arrival_dates.id")
            ->whereIn("mt_delivery_destinations.id", $deliveryDestinationIds)
            ->orderBy("mt_delivery_destinations.delivery_destination_id")->get();

        return $result;
    }

    /**
     * 納品先リスト ファイルインポート登録
     * @param $params
     * @return Object
     */
    public function importUpdate($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            //納品先マスタ, 得意先別納品先マスタ, へ登録
            foreach ($params as $param) {
                foreach ($param as $rec) {
                    //納品先登録
                    $mtDeliveryDestinationExists = MtDeliveryDestination::where('delivery_destination_id', str_pad($rec['納品先コード'], 6, 0, STR_PAD_LEFT))->exists();
                    if ($mtDeliveryDestinationExists) {
                        //更新
                        $mtDeliveryDestination = MtDeliveryDestination::where('delivery_destination_id', str_pad($rec['納品先コード'], 6, 0, STR_PAD_LEFT))->first();
                    } else {
                        //新規登録
                        $mtDeliveryDestination = new MtDeliveryDestination();
                        $mtDeliveryDestination->delivery_destination_id = str_pad($rec['納品先コード'], 6, 0, STR_PAD_LEFT);
                        $mtDeliveryDestination->mt_user_register_id = Auth::user()->id;
                    }
                    if (isset($rec['納品先名'])) $mtDeliveryDestination->delivery_destination_name = $rec['納品先名'];
                    if (isset($rec['名カナ'])) $mtDeliveryDestination->delivery_destination_name_kana = $rec['名カナ'];
                    if (isset($rec['敬称区分']) && '' != $rec['敬称区分']) $mtDeliveryDestination->honorific_kbn = $rec['敬称区分'];
                    if (isset($rec['郵便番号'])) $mtDeliveryDestination->post_number = $rec['郵便番号'];
                    if (isset($rec['住所'])) $mtDeliveryDestination->address = $rec['住所'];
                    if (isset($rec['TEL'])) $mtDeliveryDestination->tel = $rec['TEL'];
                    if (isset($rec['FAX'])) $mtDeliveryDestination->fax = $rec['FAX'];
                    if (isset($rec['代表者名'])) $mtDeliveryDestination->representative_name = $rec['代表者名'];
                    if (isset($rec['代表者名E-Mail'])) $mtDeliveryDestination->representative_mail = $rec['代表者名E-Mail'];
                    if (isset($rec['納品先担当者名'])) $mtDeliveryDestination->delivery_destination_manager_name = $rec['納品先担当者名'];
                    if (isset($rec['納品先担当者名E-Mail'])) $mtDeliveryDestination->delivery_destination_manager_mail = $rec['納品先担当者名E-Mail'];
                    if (isset($rec['納品先URL'])) $mtDeliveryDestination->delivery_destination_url = $rec['納品先URL'];
                    if (isset($rec['館内配送料'])) $mtDeliveryDestination->delivery_price = $rec['館内配送料'];
                    if (isset($rec['名称入力区分']) && '' != $rec['名称入力区分']) $mtDeliveryDestination->name_input_kbn = $rec['名称入力区分'];
                    if (isset($rec['削除区分(納品先)']) && '' != $rec['削除区分(納品先)']) $mtDeliveryDestination->del_kbn_delivery_destination = $rec['削除区分(納品先)'];
                    $mtDeliveryDestination->mt_user_last_update_id = Auth::user()->id;
                    $mtDeliveryDestination->save();

                    //得意先別納品先マスタ
                    if (isset($rec['得意先コード']) && '' != $rec['得意先コード']) {
                        $customer = MtCustomer::where('customer_cd', str_pad($rec['得意先コード'], 6, 0, STR_PAD_LEFT))->first();
                        $mtCustomerDeliveryDestinationExists = MtCustomerDeliveryDestination::where('mt_delivery_destination_id', $mtDeliveryDestination['id'])->where('mt_customer_id', $customer['id'])->exists();
                        if ($mtCustomerDeliveryDestinationExists) {
                            //更新
                            $mtCustomerDeliveryDestination = MtCustomerDeliveryDestination::where('mt_delivery_destination_id', $mtDeliveryDestination['id'])->where('mt_customer_id', $customer['id'])->first();
                        } else {
                            //新規登録
                            $mtCustomerDeliveryDestination = new MtCustomerDeliveryDestination();
                            $mtCustomerDeliveryDestination->mt_customer_id = $customer['id'];
                            $mtCustomerDeliveryDestination->mt_delivery_destination_id = $mtDeliveryDestination['id'];
                        }
                    }
                    if (!empty($rec['削除区分(得意先)'])) $mtCustomerDeliveryDestination->del_kbn_customer = $rec['削除区分(得意先)'];
                    if (!empty($rec['売上確定時印刷用紙'])) $mtCustomerDeliveryDestination->sale_decision_print_paper_flg  = $rec['売上確定時印刷用紙'];
                    if (!empty($rec['納品先着日コード'])) {
                        $code = DefArrivalDate::where('arrival_date_cd', $rec['納品先着日コード'])->first();
                        $mtCustomerDeliveryDestination->def_arrival_date_id = $code['id'];
                    }
                    if (!empty($rec['直送手数料請求'])) $mtCustomerDeliveryDestination->direct_delivery_commission_demand_flg  = $rec['直送手数料請求'];
                    if (!empty($rec['ルートコード'])) {
                        $code = MtRoot::where('root_cd', $rec['ルートコード'])->first();
                        $mtCustomerDeliveryDestination->mt_root_id = $code['id'];
                    }

                    //運送会社コード
                    if (!empty($rec['運送会社コード'])) {
                        $code = MtItemClass::where('item_class_cd', $rec['運送会社コード'])->where('def_item_class_thing_id', 1)->first();
                        $mtCustomerDeliveryDestination->mt_item_class_shipping_companie_id = $code['id'];
                    }

                    if (isset($rec['納品先備考1'])) $mtCustomerDeliveryDestination->delivery_destination_memo_1 = $rec['納品先備考1'];
                    if (isset($rec['納品先備考2'])) $mtCustomerDeliveryDestination->delivery_destination_memo_2 = $rec['納品先備考2'];
                    if (isset($rec['納品先備考3'])) $mtCustomerDeliveryDestination->delivery_destination_memo_3 = $rec['納品先備考3'];
                    if (!empty($rec['登録種別'])) $mtCustomerDeliveryDestination->register_kind_flg = $rec['登録種別'];
                    $mtCustomerDeliveryDestination->mt_user_last_update_id = Auth::user()->id;
                    $mtCustomerDeliveryDestination->save();
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
            Log::info($result);
        }
        return $result;
    }

    /**
     * 納品先 仮登録データ削除
     * @param $params
     * @return Object
     */
    public function tempDataDelete()
    {
        //「得意先別納品先マスタ.登録種別フラグ==0(仮登録）」のデータを削除
        $result = array();
        try {
            DB::beginTransaction();
            $mtCustomerDeliveryDestinations = MtCustomerDeliveryDestination::where('register_kind_flg', 0)->get();
            foreach ($mtCustomerDeliveryDestinations as $data) {
                $data->delete();
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

    /**
     * 納品先 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['delivery_destination_id'] ? CodeUtil::pad($params['delivery_destination_id'], 6) : null;

        $query = MtDeliveryDestination::query();
        $query->where('delivery_destination_id', $code);

        return $query->first();
    }

    /**
     * 使用できる納品先コードを取得
     * @param $id
     * @return Object
     */
    private function getNextDeliveryDestinationId()
    {
        $numbering = Numbering::first();
        $delivery_destination_id = intval($numbering->now_delivery_destination_id);

        $deliveryDestination = "";
        while (!is_null($deliveryDestination)) {
            $delivery_destination_id++;
            $deliveryDestination = MtDeliveryDestination::where('delivery_destination_id', str_pad($delivery_destination_id, 6, 0, STR_PAD_LEFT))->first();
        }
        return str_pad($delivery_destination_id, 6, 0, STR_PAD_LEFT);
    }
}
