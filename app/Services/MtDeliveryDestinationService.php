<?php

namespace App\Services;

use App\Repositories\MtDeliveryDestination\MtDeliveryDestinationRepository;
use App\Http\Resources\MtDeliveryDestination\MtDeliveryDestinationResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Consts\CommonConsts;
use App\Models\MtDeliveryDestination;

/**
 * 納品先マスタ関連 サービスクラス
 */
class MtDeliveryDestinationService
{

    /**
     * @var MtDeliveryDestinationRepository
     */
    private MtDeliveryDestinationRepository $MtDeliveryDestinationRepository;

    /**
     * @param MtDeliveryDestinationRepository $MtDeliveryDestinationRepository
     */
    public function __construct()
    {
        $this->MtDeliveryDestinationRepository = new MtDeliveryDestinationRepository();
    }

    /** 納品先  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->MtDeliveryDestinationRepository->getAll();
        return $datas;
    }

    /** 納品先  初期データ取得
     * @param $params
     * @return $rows
     */
    public function getInitData($params)
    {
        $datas = $this->MtDeliveryDestinationRepository->getInitData($params);
        return $datas;
    }

    /** 納品先  条件取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->MtDeliveryDestinationRepository->get($params);
        return $datas;
    }

    /** 納品先  取得(ID指定)
     * @param $id
     * @return $rows
     */
    public function getDetailById($id, $customer_id = null)
    {
        $datas = $this->MtDeliveryDestinationRepository->getDetailById($id, $customer_id);
        return $datas;
    }

    /** 納品先入力(一覧)  更新
     *
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->MtDeliveryDestinationRepository->update($params);
        return $datas;
    }

    /** 納品先入力(詳細)  更新
     *
     * @return $rows
     */
    public function updateDetail($params)
    {
        $datas = $this->MtDeliveryDestinationRepository->updateDetail($params);
        return $datas;
    }

    /** 納品先入力(一覧)  削除
     * @param $delete
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->MtDeliveryDestinationRepository->delete($id);
        return $datas;
    }

    /** 納品先入力(詳細)  削除
     * @param $delete
     * @return $rows
     */
    public function deleteDetail($id)
    {
        $datas = $this->MtDeliveryDestinationRepository->delete($id);
        return $datas;
    }

    /** 納品先入力  最小値の取得
     * @param $params
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->MtDeliveryDestinationRepository->getMinId();
        return $datas;
    }

    /** 納品先入力  最大値の取得
     * @param $params
     * @return $rows
     */
    public function getMaxId()
    {
        $datas = $this->MtDeliveryDestinationRepository->getMaxId();
        return $datas;
    }

    /** 納品先入力  納品コードの最小値の取得
     * @param $params
     * @return $rows
     */
    public function getMinCode()
    {
        $datas = $this->MtDeliveryDestinationRepository->getMinCode();
        return $datas;
    }

    /** 納品先入力  納品コードの最大値の取得
     * @param $params
     * @return $rows
     */
    public function getMaxCode()
    {
        $datas = $this->MtDeliveryDestinationRepository->getMaxCode();
        return $datas;
    }

    /** 納品先入力  前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->MtDeliveryDestinationRepository->getPrevById($id);
        return $datas;
    }

    /** 納品先入力  次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->MtDeliveryDestinationRepository->getNextById($id);
        return $datas;
    }

    /** 納品先リスト(一覧)  ファイル出力
     *
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->MtDeliveryDestinationRepository->export($params);
        $datas = MtDeliveryDestinationResource::collection($result);
        return $datas;
    }


    /** 納品先  インポートファイルのバリデーションチェック
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
        $result = array();
        // 項目の存在チェック
        $baseKeys = [
            '得意先コード',
            '納品先コード',
            '納品先名',
            // '名カナ',
            '敬称区分',
            // '郵便番号',
            // '住所',
            // 'TEL',
            // 'FAX',
            // '代表者名',
            // '代表者名E-Mail',
            // '納品先担当者名',
            // '納品先担当者名E-Mail',
            // '納品先URL',
            '名称入力区分',
            '削除区分(得意先)',
            '削除区分(納品先)',
            // '館内配送料',
            'ルートコード',
            '運送会社コード',
            // '納品先着日コード',
            '直送手数料請求',
            '売上確定時印刷用紙',
            // '納品先備考1',
            // '納品先備考2',
            // '納品先備考3',
            '登録種別',
        ];

        //項目エラーチェック
        $keys = array_keys($params[0][0]);
        $diff = array_diff($baseKeys, $keys);   //$baseKeysに存在して、$keysに存在しないものを抽出
        if (!empty($diff)) {
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = 'Excelに「' . implode(",", $diff) . '」列がありません';
            \Log::info($result);
            return $result;
        }

        // フォーマットチェック
        // 得意先コード、納品先コードはデータ更新時に0補完を行う
        $rules = [
            '得意先コード' => [
                'required',
                'max:6',
                'exists:mt_customers,customer_cd'
            ],
            '納品先コード' => [
                'required',
                'max:6'
            ],
            '納品先名' => [
                'required',
                'max:60'
            ],
            '名カナ' => [
                'nullable',
                'max:10'
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
            '代表者名E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '納品先担当者名' => [
                'nullable',
                'max:30',
            ],
            '納品先担当者名E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '納品先URL' => [
                'nullable',
                'max:2083',
            ],
            '名称入力区分' => [
                'nullable',
                'in:0,1',
            ],
            '削除区分(得意先)' => [
                'required',
                'in:0,1',
            ],
            '削除区分(納品先)' => [
                'required',
                'in:0,1',
            ],
            '館内配送料' => [
                'nullable',
                'numeric',
            ],
            'ルートコード' => [
                'required',
                'exists:mt_roots,root_cd'
            ],
            '運送会社コード' => [
                'required',
                'exists:mt_item_classes,item_class_cd'
            ],
            '納品先着日コード' => [
                'nullable',
                'exists:def_arrival_dates,arrival_date_cd'
            ],
            '直送手数料請求' => [
                'required',
                'in:0,1'
            ],
            '売上確定時印刷用紙' => [
                'required',
                'in:1,2'
            ],
            '納品先備考1' => [
                'nullable',
                'max:30',
            ],
            '納品先備考2' => [
                'nullable',
                'max:30',
            ],
            '納品先備考3' => [
                'nullable',
                'max:30',
            ],
            '登録種別' => [
                'required',
                'in:0,1,2',
            ],
        ];

        $updateRules = [
            '得意先コード' => [
                'nullable',
                'max:6',
                'exists:mt_customers,customer_cd'
            ],
            '納品先コード' => [
                'required',
                'max:6'
            ],
            '納品先名' => [
                'nullable',
                'max:60'
            ],
            '名カナ' => [
                'nullable',
                'max:10'
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
            '代表者名E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '納品先担当者名' => [
                'nullable',
                'max:30',
            ],
            '納品先担当者名E-Mail' => [
                'nullable',
                'max:256',
                'email',
            ],
            '納品先URL' => [
                'nullable',
                'max:2083',
            ],
            '名称入力区分' => [
                'nullable',
                'in:0,1',
            ],
            '削除区分(得意先)' => [
                'nullable',
                'in:0,1',
            ],
            '削除区分(納品先)' => [
                'nullable',
                'in:0,1',
            ],
            '館内配送料' => [
                'nullable',
                'numeric',
            ],
            'ルートコード' => [
                'nullable',
                'exists:mt_roots,root_cd'
            ],
            '運送会社コード' => [
                'nullable',
                'exists:mt_item_classes,item_class_cd'
            ],
            '納品先着日コード' => [
                'nullable',
                'exists:def_arrival_dates,arrival_date_cd'
            ],
            '直送手数料請求' => [
                'nullable',
                'in:0,1'
            ],
            '売上確定時印刷用紙' => [
                'nullable',
                'in:1,2'
            ],
            '納品先備考1' => [
                'nullable',
                'max:30',
            ],
            '納品先備考2' => [
                'nullable',
                'max:30',
            ],
            '納品先備考3' => [
                'nullable',
                'max:30',
            ],
            '登録種別' => [
                'nullable',
                'in:0,1,2',
            ],
        ];

        $attributes = [
            '得意先コード' => '得意先コード',
            '納品先コード' => '納品先コード',
            '納品先名' => '納品先名',
            '名カナ' => '名カナ',
            '敬称区分' => '敬称区分',
            '郵便番号' => '郵便番号',
            '住所' => '住所',
            'TEL' => 'TEL',
            'FAX' => 'FAX',
            '代表者名' => '代表者名',
            '代表者名E-Mail' => '代表者名E-Mail',
            '納品先担当者名' => '納品先担当者名',
            '納品先担当者名E-Mail' => '納品先担当者名E-Mail',
            '納品先URL' => '納品先URL',
            '名称入力区分' => '名称入力区分',
            '削除区分(得意先)' => '削除区分(得意先)',
            '削除区分(納品先)' => '削除区分(納品先)',
            '館内配送料' => '館内配送料',
            'ルートコード' => 'ルートコード',
            '運送会社コード' => '運送会社コード',
            '納品先着日コード' => '納品先着日コード',
            '直送手数料請求' => '直送手数料請求',
            '売上確定時印刷用紙' => '売上確定時印刷用紙',
            '納品先備考1' => '納品先備考1',
            '納品先備考2' => '納品先備考2',
            '納品先備考3' => '納品先備考3',
            '登録種別' => '登録種別',
        ];

        //エラー格納用
        $upload_error_list = array();
        $rowErrors = array(); //行ごとのエラーと番号を記録
        foreach ($params as $param) {
            $errorMessage = array();  //画面用エラー
            $columnErrors = array();  //出力用　列ごとのエラーを記載
            foreach ($param as $key => $value) {
                $mtDeliveryDestinationExists = MtDeliveryDestination::where('delivery_destination_id', str_pad($value['納品先コード'], 6, 0, STR_PAD_LEFT))->exists();
                if ($mtDeliveryDestinationExists) {
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

    /** 納品先 インポートファイルのDB更新
     *
     * @return $result
     */
    public function importUpdate($params)
    {
        $result = $this->MtDeliveryDestinationRepository->importUpdate($params);
        return $result;
    }

    /** 納品先 仮登録データ削除
     *
     * @return $result
     */
    public function tempDataDelete()
    {
        $result = $this->MtDeliveryDestinationRepository->tempDataDelete();
        return $result;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->MtDeliveryDestinationRepository->getByCode($params);
        return $datas;
    }
}
