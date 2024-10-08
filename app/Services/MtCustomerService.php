<?php

namespace App\Services;

use App\Repositories\MtCustomer\MtCustomerRepository;
use App\Http\Resources\MtCustomer\MtCustomerListResource;
use Illuminate\Support\Facades\Validator;
use App\Consts\CommonConsts;
use App\Models\MtCustomer;
use App\Models\MtBillingAddress;

/**
 * 得意先マスタ関連 サービスクラス
 */
class MtCustomerService
{

    /**
     * @var MtCustomerRepository
     */
    private MtCustomerRepository $mtCustomerRepository;

    /**
     * @param MtCustomerRepository $mtCustomerRepository
     */
    public function __construct()
    {
        $this->mtCustomerRepository = new MtCustomerRepository();
    }

    /** 得意先  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtCustomerRepository->getAll();
        return $datas;
    }

    /** 得意先  全件取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtCustomerRepository->get($params);
        return $datas;
    }

    public function getById($params)
    {
        $id = $params['id'];
        $data = $this->mtCustomerRepository->getById($id);
        return $data;
    }

    /** 得意先  IDにより詳細取得
     * @param $id
     * @return $rows
     */
    public function getDetailById($id)
    {
        $datas = $this->mtCustomerRepository->getDetailById($id);
        return $datas;
    }

    /** 得意先  最小ID取得
     * @return $rows
     */
    public function getMinCode()
    {
        $datas = $this->mtCustomerRepository->getMinCode();
        return $datas;
    }

    /** 得意先  最大ID取得
     * @return $rows
     */
    public function getMaxCode()
    {
        $datas = $this->mtCustomerRepository->getMaxCode();
        return $datas;
    }

    /** 得意先  前頁
     * @param $id
     * @return $rows
     */
    public function getPrevByCode($code)
    {
        $datas = $this->mtCustomerRepository->getPrevByCode($code);
        return $datas;
    }

    /** 得意先  次頁
     * @param $id
     * @return $rows
     */
    public function getNextByCode($code)
    {
        $datas = $this->mtCustomerRepository->getNextByCode($code);
        return $datas;
    }

    /** 得意先  更新
     *
     * @return $rows
     */
    public function update($id, $params)
    {
        $datas = $this->mtCustomerRepository->update($id, $params);
        return $datas;
    }

    /** 得意先  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtCustomerRepository->delete($id);
        return $datas;
    }

    /** 得意先  残高取得
     *
     * @return $rows
     */
    public function getBalance($id)
    {
        $datas = $this->mtCustomerRepository->getBalance($id);
        return $datas;
    }

    /** 得意先  残高更新
     *
     * @return $rows
     */
    public function updateBalance($id, $params)
    {
        $datas = $this->mtCustomerRepository->updateBalace($id, $params);
        return $datas;
    }

    /** 得意先  ファイル出力対象の取得
     *
     * @return $result
     */
    public function export($params)
    {
        $datas = $this->mtCustomerRepository->export($params);
        $result = MtCustomerListResource::collection($datas);
        return $result;
    }

    /** 得意先  インポートファイルのバリデーションチェック
     *
     * @return $result
     */
    public function checkImportFormat($params)
    {
        if (!isset($params[0]) || count($params[0]) === 0) {
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = '更新対象のデータがありません。';
            return $result;
        }

        Validator::extend('checkClosingDate', function ($attribute, $value, $parameters, $validator) {
            $customer_cd = $validator->getData('得意先コード');
            $billing_address_cd = $validator->getData('請求先コード');
            $mtBillingAddress = MtBillingAddress::where('billing_address_cd', $billing_address_cd)->first();
            $mtCustomer = MtCustomer::where('customer_cd', $customer_cd)->first();
            $originalBillingAddress = MtBillingAddress::where('id', $mtCustomer->mt_billing_address_id)->first();
            if (!empty($originalBillingAddress) && $originalBillingAddress->id != $mtBillingAddress->id) {
                if (
                    $originalBillingAddress->closing_date_1 != $mtBillingAddress->closing_date_1
                    || $originalBillingAddress->closing_date_2 != $mtBillingAddress->closing_date_2
                    || $originalBillingAddress->closing_date_3 != $mtBillingAddress->closing_date_3
                ) {
                    return false;
                }
            }
            return true;
        });
        Validator::replacer('checkClosingDate', function ($message, $attribute, $rule, $parameters) {
            return '締日の異なる得意先を指定することはできません';
        });

        Validator::extend('checkSequentiallyKbn', function ($attribute, $value, $parameters, $validator) {
            $billing_address_cd = $validator->getData('請求先コード');
            $mtBillingAddress = MtBillingAddress::where('billing_address_cd', $billing_address_cd)->first();
            if (isset($mtBillingAddress)) {
                $mtCustomer = MtCustomer::where('customer_cd', $mtBillingAddress->billing_address_cd)->first();
                return $mtCustomer->sequentially_kbn != 1;
            }
            return true;
        });
        Validator::replacer('checkSequentiallyKbn', function ($message, $attribute, $rule, $parameters) {
            return '請求先コードに随時締の得意先を指定することはできません';
        });

        Validator::extend('checkDelKbn', function ($attribute, $value, $parameters, $validator) {
            $billing_address_cd = $validator->getData('請求先コード');
            $mtBillingAddress = MtBillingAddress::where('billing_address_cd', $billing_address_cd)->first();
            if (isset($mtBillingAddress)) {
                $mtCustomer = MtCustomer::where('customer_cd', $mtBillingAddress->billing_address_cd)->first();
                return $mtCustomer->del_kbn != 1;
            }
            return true;
        });
        Validator::replacer('checkDelKbn', function ($message, $attribute, $rule, $parameters) {
            return '請求先コードは削除区分が有効になっているコードです';
        });

        Validator::extend('checkDiffrentCode', function ($attribute, $value, $parameters, $validator) {
            $billing_address_cd = $validator->getData('請求先コード');
            $mtBillingAddress = MtBillingAddress::where('billing_address_cd', $billing_address_cd)->first();
            if (isset($mtBillingAddress)) {
                $mtCustomer = MtCustomer::where('customer_cd', $mtBillingAddress->billing_address_cd)->first();
                return !empty($mtCustomer) && $mtCustomer->customer_cd != $mtBillingAddress->billing_address_cd;
            }
            return true;
        });
        Validator::replacer('checkDiffrentCode', function ($message, $attribute, $rule, $parameters) {
            return '請求先コードにこの得意先を指定することはできません';
        });

        $result = array();
        // 項目の存在チェック
        $baseKeys = [
            '得意先コード',
            '得意先名',
            // '名カナ',
            '請求先コード',
            // '付箋(特記事項)',
            '入金区分',
            '担当者コード',
            '敬称区分',
            // '郵便番号',
            // '住所',
            // 'TEL',
            // 'FAX',
            // '代表者名',
            // '代表者E-Mail',
            // '得意先担当者名',
            // '得意先担当者E-Mail',
            '単価掛率',
            // '与信限度額',
            '与信限度額チェック',
            '販売パターン1コード',
            // '業種・特徴2コード',
            // 'ランク3コード',
            // '地区分類コード',
            // '開拓年分類コード',
            // '請求書通知用E-Mail1',
            // '請求書通知用E-Mail2',
            // '入金案内用E-Mail',
            '入金案内送信要不要',
            // '得意先URL',
            '名称入力区分',
            '削除区分',
            '消費税運賃掛率適用',
            // '館内配送料',
            '受注倉庫コード',
            'ルートコード',
            '運送会社コード',
            '得意先着日コード',
            '売上伝票種別コード',
            '請求書種別',
            '直送納品書郵送要不要',
            '請求書郵送要不要',
            '売上確定時印刷用紙',
            // '得意先備考1',
            // '得意先備考2',
            // '得意先備考3',
            // '得意先拡張1',
            // '得意先拡張2',
            // '得意先拡張3',
            // '得意先拡張4',
            // '得意先拡張5'
        ];

        //項目エラーチェック
        $keys = array_keys($params[0][0]);
        $diff = array_diff($baseKeys, $keys);   //$baseKeysに存在して、$keysに存在しないものを抽出
        if (!empty($diff)) {
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = 'Excelに「' . implode(",", $diff) . '」列がありません';
            return $result;
        }

        // フォーマットチェック
        $rules = [
            '得意先コード' => [
                'required',
                'digits:6'
            ],
            '得意先名' => [
                'required',
                'max:60'
            ],
            '名カナ' => [
                'nullable',
                'max:10'
            ],
            '請求先コード' => [
                'required',
                'digits:6',
                'checkSequentiallyKbn',
                'checkDelKbn',
                'checkDiffrentCode'
            ],
            '付箋(特記事項)' => [
                'nullable',
                'exists:mt_order_receive_sticky_notes,id'
            ],
            '入金区分' => [
                'required',
                'in: 1,2'
            ],
            '担当者コード' => [
                'required',
                'exists:mt_users,user_cd'
            ],
            '敬称区分' => [
                'required',
                'in: 1,2'
            ],
            '郵便番号' => [
                'nullable',
                'max:8',
                'regex:/\A\d{3}[-]\d{4}\z/'
            ],
            '住所' => [
                'nullable',
                'max:90',
            ],
            'TEL' => [
                'nullable',
                'max:15',
                'regex:/^[0-9-]+$/'
            ],
            'FAX' => [
                'nullable',
                'max:15',
                'regex:/^[0-9-]+$/'
            ],
            '代表者名' => [
                'nullable',
                'max:30',
            ],
            '代表者E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '得意先担当者コード' => [
                'nullable',
                'digits:4',
                'exists:mt_managers,manager_cd'
            ],
            '得意先担当者名' => [
                'nullable',
                'max:30',
            ],
            '得意先担当者E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '単価掛率' => [
                'required',
                'integer',
                'max:100',
            ],
            '与信限度額' => [
                'nullable',
                'numeric',
            ],
            '与信限度額チェック' => [
                'required',
                'in:0,1',
            ],
            '販売パターン1コード' => [
                'required',
                'exists:mt_customer_classes,customer_class_cd'
            ],
            '業種・特徴2コード' => [
                'nullable',
                'exists:mt_customer_classes,customer_class_cd'
            ],
            'ランク3コード' => [
                'nullable',
                'exists:mt_customer_classes,customer_class_cd'
            ],
            '地区分類コード' => [
                'nullable',
                'exists:def_district_classes,district_class_cd'
            ],
            '開拓年分類コード' => [
                'nullable',
                'exists:def_pioneer_years,pioneer_year_cd'
            ],
            '請求書通知用E-Mail1' => [
                'nullable',
                'max:256',
                'email',
            ],
            '請求書通知用E-Mail2' => [
                'nullable',
                'max:256',
                'email',
            ],
            '入金案内用E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '入金案内送信要不要' => [
                'required',
                'in:1,2',
            ],
            '得意先URL' => [
                'nullable',
                'max:2083',
            ],
            '名称入力区分' => [
                'nullable',
                'in:0,1',
            ],
            '削除区分' => [
                'nullable',
                'in:0,1',
            ],
            '消費税運賃掛率適用' => [
                'nullable',
                'in:0,1',
            ],
            '館内配送料' => [
                'nullable',
                'numeric',
            ],
            '受注倉庫コード' => [
                'required',
                'exists:mt_warehouses,warehouse_cd'
            ],
            'ルートコード' => [
                'required',
                'exists:mt_roots,root_cd'
            ],
            '運送会社コード' => [
                'required',
                'exists:mt_item_classes,item_class_cd'
            ],
            '得意先着日コード' => [
                'nullable',
                'exists:def_arrival_dates,arrival_date_cd'
            ],
            '売上伝票種別コード' => [
                'required',
                'exists:mt_slip_kinds,slip_kind_cd'
            ],
            '請求書種別' => [
                'required',
                'in:1,2'
            ],
            '直送納品書郵送要不要' => [
                'required',
                'in:1,2'
            ],
            '請求書郵送要不要' => [
                'required',
                'in:1,2'
            ],
            '売上確定時印刷用紙' => [
                'required',
                'in:1,2'
            ],
            '得意先備考1' => [
                'nullable',
                'max:30',
            ],
            '得意先備考2' => [
                'nullable',
                'max:30',
            ],
            '得意先備考3' => [
                'nullable',
                'max:30',
            ],
            '得意先拡張1' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張2' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張3' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張4' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張5' => [
                'nullable',
                'max:20',
            ]
        ];

        $updateRules = [
            '得意先コード' => [
                'required',
                'digits:6'
            ],
            '得意先名' => [
                'nullable',
                'max:60'
            ],
            '名カナ' => [
                'nullable',
                'max:10'
            ],
            '請求先コード' => [
                'nullable',
                'digits:6',
                'exists:mt_billing_addresses,billing_address_cd',
                'checkClosingDate',
                'checkSequentiallyKbn',
                'checkDelKbn',
                'checkDiffrentCode'
            ],
            '付箋(特記事項)' => [
                'nullable',
                'exists:mt_order_receive_sticky_notes,id'
            ],
            '入金区分' => [
                'nullable',
                'in: 1,2'
            ],
            '担当者コード' => [
                'nullable',
                'exists:mt_users,user_cd'
            ],
            '敬称区分' => [
                'nullable',
                'in: 1,2'
            ],
            '郵便番号' => [
                'nullable',
                'max:8',
                'regex:/\A\d{3}[-]\d{4}\z/'
            ],
            '住所' => [
                'nullable',
                'max:90',
            ],
            'TEL' => [
                'nullable',
                'max:15',
                'regex:/^[0-9-]+$/'
            ],
            'FAX' => [
                'nullable',
                'max:15',
                'regex:/^[0-9-]+$/'
            ],
            '代表者名' => [
                'nullable',
                'max:30',
            ],
            '代表者E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '得意先担当者コード' => [
                'nullable',
                'digits:4',
                'exists:mt_managers,manager_cd'
            ],
            '得意先担当者名' => [
                'nullable',
                'max:30',
            ],
            '得意先担当者E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '単価掛率' => [
                'nullable',
                'integer',
                'max:100',
            ],
            '与信限度額' => [
                'nullable',
                'numeric',
            ],
            '与信限度額チェック' => [
                'nullable',
                'in:0,1',
            ],
            '販売パターン1コード' => [
                'nullable',
                'exists:mt_customer_classes,customer_class_cd'
            ],
            '業種・特徴2コード' => [
                'nullable',
                'exists:mt_customer_classes,customer_class_cd'
            ],
            'ランク3コード' => [
                'nullable',
                'exists:mt_customer_classes,customer_class_cd'
            ],
            '地区分類コード' => [
                'nullable',
                'exists:def_district_classes,district_class_cd'
            ],
            '開拓年分類コード' => [
                'nullable',
                'exists:def_pioneer_years,pioneer_year_cd'
            ],
            '請求書通知用E-Mail1' => [
                'nullable',
                'max:256',
                'email',
            ],
            '請求書通知用E-Mail2' => [
                'nullable',
                'max:256',
                'email',
            ],
            '入金案内用E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '入金案内送信要不要' => [
                'nullable',
                'in:1,2',
            ],
            '得意先URL' => [
                'nullable',
                'max:2083',
            ],
            '名称入力区分' => [
                'nullable',
                'in:0,1',
            ],
            '削除区分' => [
                'nullable',
                'in:0,1',
            ],
            '消費税運賃掛率適用' => [
                'nullable',
                'in:0,1',
            ],
            '館内配送料' => [
                'nullable',
                'numeric',
            ],
            '受注倉庫コード' => [
                'nullable',
                'exists:mt_warehouses,warehouse_cd'
            ],
            'ルートコード' => [
                'nullable',
                'exists:mt_roots,root_cd'
            ],
            '運送会社コード' => [
                'nullable',
                'exists:mt_item_classes,item_class_cd'
            ],
            '得意先着日コード' => [
                'nullable',
                'exists:def_arrival_dates,arrival_date_cd'
            ],
            '売上伝票種別コード' => [
                'nullable',
                'exists:mt_slip_kinds,slip_kind_cd'
            ],
            '請求書種別' => [
                'nullable',
                'in:1,2'
            ],
            '直送納品書郵送要不要' => [
                'nullable',
                'in:1,2'
            ],
            '請求書郵送要不要' => [
                'nullable',
                'in:1,2'
            ],
            '売上確定時印刷用紙' => [
                'nullable',
                'in:1,2'
            ],
            '得意先備考1' => [
                'nullable',
                'max:30',
            ],
            '得意先備考2' => [
                'nullable',
                'max:30',
            ],
            '得意先備考3' => [
                'nullable',
                'max:30',
            ],
            '得意先拡張1' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張2' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張3' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張4' => [
                'nullable',
                'max:20',
            ],
            '得意先拡張5' => [
                'nullable',
                'max:20',
            ]
        ];

        $attributes = [
            '得意先コード' => '得意先コード',
            '得意先名' => '得意先名',
            '名カナ' => '名カナ',
            '請求先コード' => '請求先コード',
            '付箋(特記事項)' => '付箋(特記事項)',
            '入金区分' => '入金区分',
            '担当者コード' => '担当者コード',
            '敬称区分' => '敬称区分',
            '郵便番号' => '郵便番号',
            '住所' => '住所',
            'TEL' => 'TEL',
            'FAX' => 'FAX',
            '代表者名' => '代表者名',
            '代表者E-Mail' => '代表者E-Mail',
            '得意先担当者コード' => '得意先担当者コード',
            '得意先担当者名' => '得意先担当者名',
            '得意先担当者E-Mail' => '得意先担当者E-Mail',
            'ECログインID' => 'ECログインID',
            '単価掛率' => '単価掛率',
            '与信限度額' => '与信限度額',
            '与信限度額チェック' => '与信限度額チェック',
            '販売パターン1コード' => '販売パターン1コード',
            '業種・特徴2コード' => '業種・特徴2コード',
            'ランク3コード' => 'ランク3コード',
            '地区分類コード' => '地区分類コード',
            '開拓年分類コード' => '開拓年分類コード',
            '請求書通知用E-Mail1' => '請求書通知用E-Mail1',
            '請求書通知用E-Mail2' => '請求書通知用E-Mail2',
            '入金案内用E-Mail' => '入金案内用E-Mail',
            '入金案内送信要不要' => '入金案内送信要不要',
            '得意先URL' => '得意先URL',
            '名称入力区分' => '名称入力区分',
            '削除区分' => '削除区分',
            '消費税運賃掛率適用' => '消費税運賃掛率適用',
            '館内配送料' => '館内配送料',
            '受注倉庫コード' => '受注倉庫コード',
            'ルートコード' => 'ルートコード',
            '運送会社コード' => '運送会社コード',
            '得意先着日コード' => '得意先着日コード',
            '売上伝票種別コード' => '売上伝票種別コード',
            '請求書種別' => '請求書種別',
            '直送納品書郵送要不要' => '直送納品書郵送要不要',
            '請求書郵送要不要' => '請求書郵送要不要',
            '売上確定時印刷用紙' => '売上確定時印刷用紙',
            '得意先備考1' => '得意先備考1',
            '得意先備考2' => '得意先備考2',
            '得意先備考3' => '得意先備考3',
            '得意先拡張1' => '得意先拡張1',
            '得意先拡張2' => '得意先拡張2',
            '得意先拡張3' => '得意先拡張3',
            '得意先拡張4' => '得意先拡張4',
            '得意先拡張5' => '得意先拡張5',
        ];

        //エラー格納用
        $upload_error_list = array();
        $rowErrors = array(); //行ごとのエラーと番号を記録
        foreach ($params as $param) {
            $errorMessage = array();  //画面用エラー
            $columnErrors = array();  //出力用　列ごとのエラーを記載
            foreach ($param as $key => $value) {
                $mtCustomerExists = MtCustomer::where('customer_cd', str_pad($value['得意先コード'], 6, 0, STR_PAD_LEFT))->exists();
                if ($mtCustomerExists) {
                    $validator = Validator::make($value, $updateRules, __('validation'), $attributes);
                } else {
                    $validator = Validator::make($value, $rules, __('validation'), $attributes);
                }

                // バリデーションエラーがあった場合
                if ($validator->fails()) {
                    // エラーメッセージを「xx行目：エラーメッセージ」の形に整える
                    $errorMessage += $validator->errors()->all();
                    $upload_error_list[] = $errorMessage;
                    $columnErrors[$key + 1] = $validator->errors();
                }
            }
            $rowErrors[] = $columnErrors;
        }
        if (empty($upload_error_list)) {
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } else {
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['rowErrors'] = $rowErrors;
            $result['failMessage'] = $upload_error_list;
        }
        return $result;
    }

    /** 得意先  インポートファイルのDB更新
     * @param
     * @return $result
     */
    public function importUpdate($params)
    {
        $result = $this->mtCustomerRepository->importUpdate($params);
        return $result;
    }

    /** 自動補完
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtCustomerRepository->getByCode($params);
        return $datas;
    }

    /** 得意先入力(詳細)  削除
     * @param $delete
     * @return $rows
     */
    public function deleteDetail($id)
    {
        $datas = $this->mtCustomerRepository->deleteDetail($id);
        return $datas;
    }

    /** 得意先入力(詳細)  更新
     *
     * @return $rows
     */
    public function updateDetail($params)
    {
        $datas = $this->mtCustomerRepository->updateDetail($params);
        return $datas;
    }
}
