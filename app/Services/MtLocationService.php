<?php

namespace App\Services;

use App\Repositories\MtLocation\MtLocationRepository;
use App\Repositories\MtWarehouse\MtWarehouseRepository;
use App\Http\Resources\MtLocation\MtLocationListResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Consts\CommonConsts;

/**
 * ロケーションマスタ関連 サービスクラス
 */
class MtLocationService
{

    /**
     * @var MtLocationRepository
     */
    private MtLocationRepository $mtLocationRepository;

    /**
     * @var MtWarehouseRepository
     */
    private MtWarehouseRepository $mtWarehouseRepository;

    /**
     * @param MtWarehouseRepository $mtWarehouseRepository
     */
    public function __construct()
    {
        $this->mtLocationRepository = new MtLocationRepository();
        $this->mtWarehouseRepository = new MtWarehouseRepository();
    }

    /** ロケーション 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtLocationRepository->getAll();
        return $datas;
    }

    /** ロケーション 初期データ取得
     *
     * @return $rows
     */
    public function getInitData($mtWarehouseId)
    {
        $datas = $this->mtLocationRepository->getInitData($mtWarehouseId);
        return $datas;
    }

    /**   最小ID取得
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->mtLocationRepository->getMinId();
        return $datas;
    }

    /**   最大ID取得
     * @return $rows
     */
    public function getMaxID()
    {
        $datas = $this->mtLocationRepository->getMaxId();
        return $datas;
    }

    /**   前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->mtLocationRepository->getPrevById($id);
        return $datas;
    }

    /**   次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->mtLocationRepository->getNextById($id);
        return $datas;
    }


    /** ロケーションマスタ  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtLocationRepository->update($params);
        return $datas;
    }

    /** ロケーションリスト  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtLocationRepository->export($params);
        $datas = MtLocationListResource::collection($result);
        return $datas;
    }

    /** ロケーションマスタ  指定条件にて取得
     * @param $id
     * @return $rows
     */
    public function get($id)
    {
        $datas = $this->mtLocationRepository->get($id);
        return $datas;
    }

    /** ロケーションマスタ  倉庫指定で取得
     * @param $params
     * @return $rows
     */
    public function getByWarehouseId($params)
    {
        $datas = $this->mtLocationRepository->getByWarehouseId($params);
        return $datas;
    }

    /* ロケーションリスト表示用　倉庫マスタ初期データ取得
     * @return $string
     */
    public function getInitWarehouseCd()
    {
        $datas = $this->mtWarehouseRepository->getInitCode();
        return $datas;
    }

    /** ロケーションマスタ インポートファイルのバリデーションチェック
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
            '倉庫コード',
            'JANコード',
            '棚番1',
            '棚番2',
        ];

        //項目エラーチェック
        $keys = array_keys($params[0][0]);
        $diff = array_diff($baseKeys, $keys);   //$baseKeysに存在して、$keysに存在しないものを抽出
        if (!empty($diff)) {
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = 'エラー内容：Excelに「' . implode(",", $diff) . '」列がありません';
            return $result;
        }

        // フォーマットチェック
        $rules = [
            '倉庫コード' => [
                'required',
                'digits:6',
                'exists:mt_warehouses,warehouse_cd'
            ],
            'JANコード' => [
                'required',
                'exists:mt_stock_keeping_units,jan_cd'
            ],
            '棚番1' => [
                'required',
                'max:10'
            ],
            '棚番2' => [
                'nullable',
                'max:10',
            ],
        ];
        $attributes = [
            '倉庫コード' => '倉庫コード',
            'JANコード' => 'JANコード',
            '棚番1' => '棚番1',
            '棚番2' => '棚番2',
        ];

        //エラー格納用
        $upload_error_list = array();
        $rowErrors = array(); //行ごとのエラーと番号を記録
        foreach ($params as $param) {
            $errorMessage = array();  //画面用エラー
            $columnErrors = array();  //出力用　列ごとのエラーを記載
            foreach ($param as $key => $value) {
                $validator = Validator::make($value, $rules, __('validation'), $attributes);
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

    /** ロケーションマスタ インポートファイルのDB更新
     *
     * @return $result
     */
    public function importUpdate($params)
    {
        $result = $this->mtLocationRepository->importUpdate($params);
        return $result;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->mtLocationRepository->getByCode($code);
        return $datas;
    }
}
