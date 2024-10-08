<?php

namespace App\Services;

use App\Repositories\MtItem\MtItemRepository;
use App\Repositories\MtColor\MtColorRepository;
use App\Repositories\MtSize\MtSizeRepository;
use App\Repositories\MtStockKeepingUnit\MtStockKeepingUnitRepository;
use App\Http\Resources\MtItem\MtItemByClassListResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Consts\CommonConsts;

/**
 * 商品マスタ関連 サービスクラス
 */
class MtItemService
{

    /**
     * @var mtItemRepository
     */
    private MtItemRepository $mtItemRepository;

    /**
     * @var mtColorRepository
     */
    private MtColorRepository $mtColorRepository;

    /**
     * @var mtSizeRepository
     */
    private MtSizeRepository $mtSizeRepository;

    /**
     * @var mtStockKeepingUnitRepository
     */
    private MtStockKeepingUnitRepository $mtStockKeepingUnitRepository;

    /**
     * @param MtItemRepository $mtItemRepository
     * @param MtColorRepository $mtColorRepository
     * @param MtSizeRepository $mtSizeRepository
     */
    public function __construct()
    {
        $this->mtItemRepository = new MtItemRepository();
        $this->mtStockKeepingUnitRepository = new MtStockKeepingUnitRepository();
        $this->mtColorRepository = new MtColorRepository();
        $this->mtSizeRepository = new MtSizeRepository();
    }

    /** 商品マスタ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtItemRepository->getAll();
        return $datas;
    }

    /** 商品マスタ  IDにより詳細取得
     * @param $id
     * @return $rows
     */
    public function getDetailById($id)
    {
        $datas = $this->mtItemRepository->getDetailById($id);
        return $datas;
    }

    /** 商品マスタ  最小ID取得
     * @return $rows
     */
    public function getMinCode()
    {
        $datas = $this->mtItemRepository->getMinCode();
        return $datas;
    }

    /** 商品マスタ  最大ID取得
     * @return $rows
     */
    public function getMaxCode()
    {
        $datas = $this->mtItemRepository->getMaxCode();
        return $datas;
    }

    /** 商品マスタ  前頁
     * @param $id
     * @return $rows
     */
    public function getPrevByCode($code)
    {
        $datas = $this->mtItemRepository->getPrevByCode($code);
        return $datas;
    }

    /** 商品マスタ  次頁
     * @param $id
     * @return $rows
     */
    public function getNextByCode($code)
    {
        $datas = $this->mtItemRepository->getNextByCode($code);
        return $datas;
    }

    /** 商品マスタ  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtItemRepository->delete($id);
        return $datas;
    }

    /** 商品マスタEC  削除
     * @param $id
     * @return $rows
     */
    public function deleteEcData($id)
    {
        $datas = $this->mtItemRepository->deleteEc($id);
        return $datas;
    }

    /** 商品マスタ  更新
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function update($param, $fileParam = null)
    {
        $datas = $this->mtItemRepository->update($param, $fileParam);
        return $datas;
    }

    /** 商品マスタ  条件取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtItemRepository->get($params);
        return $datas;
    }

    /**
     * 商品マスタリスト(一覧) 出力(Excel)
     * @param $service
     * @return Object
     */
    public function export($param)
    {
        $datas = $this->mtItemRepository->export($param);
        return $datas;
    }

    /**
     * 商品マスタリスト(取込原本SKU) 出力
     * @param $service
     * @return Object
     */
    public function exportSku($param)
    {
        $datas = $this->mtItemRepository->exportSku($param);
        return $datas;
    }

    /**
     * 商品マスタリスト(取込原本品番) 出力
     * @param $service
     * @return Object
     */
    public function exportItemCd($param)
    {
        $datas = $this->mtItemRepository->exportItemCd($param);
        return $datas;
    }

    /** 商品データの情報取得
     *
     * @return $rows
     */
    public function getItemData($params)
    {
        $datas = $this->mtItemRepository->getItemData($params);
        return $datas;
    }

    /**
     * 商品マスタリスト(分類別) 出力
     * @param $service
     * @return Object
     */
    public function exportByClass($param)
    {
        $result = $this->mtItemRepository->exportByClass($param);
        $datas = MtItemByClassListResource::collection($result);
        return $datas;
    }

    /** 商品コード変更 更新
     * @param $params
     * @return $rows
     */
    public function updateItemCode($params)
    {
        $datas = $this->mtItemRepository->updateItemCode($params);
        return $datas;
    }

    /** 商品  インポートファイルのバリデーションチェック
     * @param $params
     * @param $mode 0:新規/1:修正
     * @param $target 0:品番/1:SKU
     * @return $result
     */
    public function checkImportFormat($params, $mode, $target, $input_kbn)
    {
        if (!isset($params[0]) || count($params[0]) === 0) {
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = '更新対象のデータがありません。';
            return $result;
        }
        $result = array();
        // 項目の存在チェック
        //品番　登録・修正
        if ($target === '0') {
            // 新規作成
            if ($input_kbn == 0) {
                $baseKeys = [
                    "商品コード",
                    // "他品番",
                    "商品名",
                    // "名カナ",
                    // "単位名",
                    "仕入先コード",
                    "ブランド1コード",
                    // "競技・カテゴリコード",
                    // "ジャンルコード",
                    // "販売開始年コード",
                    // "工場分類5コード",
                    // "製品/工賃6コード",
                    // "資産在庫JAコード",
                    // "名称入力区分",
                    // "在庫管理区分",
                    // "非課税区分",
                    // "税率区分",
                    // "商品区分",
                    // "商品備考1",
                    // "商品備考2",
                    // "商品備考3",
                    // "商品備考4",
                    // "商品備考5",
                    // "税抜参考上代単価",
                    // "税込参考上代単価",
                    // "税抜仕入単価",
                    // "税込仕入単価",
                    // "原価単価",
                    // "粗利算出用原価単価",
                    // "税抜上代単価",
                    // "税込上代単価",
                    // "削除区分",
                    "カラーコード1",
                    // "カラーコード2",
                    // "カラーコード3",
                    // "カラーコード4",
                    // "カラーコード5",
                    // "カラーコード6",
                    // "カラーコード7",
                    // "カラーコード8",
                    // "カラーコード9",
                    // "カラーコード10",
                    // "カラーコード11",
                    // "カラーコード12",
                    // "カラーコード13",
                    // "カラーコード14",
                    // "カラーコード15",
                    // "カラーコード16",
                    // "カラーコード17",
                    // "カラーコード18",
                    // "カラーコード19",
                    // "カラーコード20",
                    "サイズコード1",
                    // "サイズコード2",
                    // "サイズコード3",
                    // "サイズコード4",
                    // "サイズコード5",
                    // "サイズコード6",
                    // "サイズコード7",
                    // "サイズコード8",
                    // "サイズコード9",
                    // "サイズコード10",
                    // "メンバーサイト商品コード",
                    // "メンバーサイト商品名",
                    // "メンバーサイト連携区分",
                ];
                // 更新
            } else {
                $baseKeys = [
                    "商品コード",
                    // "他品番",
                    // "商品名",
                    // "名カナ",
                    // "単位名",
                    // "仕入先コード",
                    // "ブランド1コード",
                    // "競技・カテゴリコード",
                    // "ジャンルコード",
                    // "販売開始年コード",
                    // "工場分類5コード",
                    // "製品/工賃6コード",
                    // "資産在庫JAコード",
                    // "名称入力区分",
                    // "在庫管理区分",
                    // "非課税区分",
                    // "税率区分",
                    // "商品区分",
                    // "商品備考1",
                    // "商品備考2",
                    // "商品備考3",
                    // "商品備考4",
                    // "商品備考5",
                    // "税抜参考上代単価",
                    // "税込参考上代単価",
                    // "税抜仕入単価",
                    // "税込仕入単価",
                    // "原価単価",
                    // "粗利算出用原価単価",
                    // "税抜上代単価",
                    // "税込上代単価",
                    // "削除区分",
                    // "カラーコード1",
                    // "カラーコード2",
                    // "カラーコード3",
                    // "カラーコード4",
                    // "カラーコード5",
                    // "カラーコード6",
                    // "カラーコード7",
                    // "カラーコード8",
                    // "カラーコード9",
                    // "カラーコード10",
                    // "カラーコード11",
                    // "カラーコード12",
                    // "カラーコード13",
                    // "カラーコード14",
                    // "カラーコード15",
                    // "カラーコード16",
                    // "カラーコード17",
                    // "カラーコード18",
                    // "カラーコード19",
                    // "カラーコード20",
                    // "サイズコード1",
                    // "サイズコード2",
                    // "サイズコード3",
                    // "サイズコード4",
                    // "サイズコード5",
                    // "サイズコード6",
                    // "サイズコード7",
                    // "サイズコード8",
                    // "サイズコード9",
                    // "サイズコード10",
                    // "メンバーサイト商品コード",
                    // "メンバーサイト商品名",
                    // "メンバーサイト連携区分",
                ];
            }
            //SKU 登録のみ
        } elseif ($target === '1') {
            $baseKeys = [
                // "JANコード",
                "商品コード",
                // "他品番",
                "商品名",
                // "名カナ",
                // "単位名",
                "カラーコード",
                "サイズコード",
                "仕入先コード",
                "ブランド1コード",
                // "競技・カテゴリコード",
                // "ジャンルコード",
                // "販売開始年コード",
                // "工場分類5コード",
                // "製品/工賃6コード",
                // "資産在庫JAコード",
                // "名称入力区分",
                // "在庫管理区分",
                // "非課税区分",
                // "税率区分",
                // "商品区分",
                // "商品備考1",
                // "商品備考2",
                // "商品備考3",
                // "商品備考4",
                // "商品備考5",
                // "税抜参考上代単価",
                // "税込参考上代単価",
                // "税抜仕入単価",
                // "税込仕入単価",
                // "原価単価",
                // "粗利算出用原価単価",
                // "税抜上代単価",
                // "税込上代単価",
                // "削除区分",
                // "メンバーサイト商品コード",
                // "メンバーサイト商品名",
                // "メンバーサイト連携区分",
            ];
        }

        //項目エラーチェック
        $keys = array_keys($params[0][0]);
        $diff = array_diff($baseKeys, $keys);   //$baseKeysに存在して、$keysに存在しないものを抽出
        if (!empty($diff)) {
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = 'Excelに「' . implode(",", $diff) . '」列がありません';
            return $result;
        }

        // フォーマットチェック
        //品番
        if ($target === '0') {
            // 新規作成
            if ($input_kbn == 0) {
                $rules = [
                    '商品コード' => [
                        'required',
                        //'max_digits:9'
                    ],
                    '他品番' => [
                        'nullable',
                        'max:20'
                    ],
                    '商品名' => [
                        'required',
                        'max:40'
                    ],
                    '名カナ' => [
                        'nullable',
                        'max:10'
                    ],
                    '単位名' => [
                        'nullable',
                        'max:4'
                    ],
                    '仕入先コード' => [
                        'required',
                        'digits:6',
                        'exists:mt_suppliers,supplier_cd'
                    ],
                    'ブランド1コード' => [
                        'required',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '競技・カテゴリコード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    'ジャンルコード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '販売開始年コード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '工場分類5コード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '製品/工賃6コード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '資産在庫JAコード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '名称入力区分' => [
                        'nullable',
                        'in: 0,1'
                    ],
                    '在庫管理区分' => [
                        'nullable',
                        'in: 0,1'
                    ],
                    '非課税区分' => [
                        'nullable',
                        'in: 0,1'
                    ],
                    '税率区分' => [
                        'nullable',
                        'exists:def_tax_rate_kbns,tax_rate_kbn_cd'
                    ],
                    '商品区分' => [
                        'nullable',
                        'in: 0,1,2,4,6'
                    ],
                    '商品備考1' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考2' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考3' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考4' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考5' => [
                        'nullable',
                        'max:30',
                    ],
                    '税抜参考上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '税込参考上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '税抜仕入単価' => [
                        'nullable',
                    ],
                    '税込仕入単価' => [
                        'nullable',
                    ],
                    '原価単価' => [
                        'nullable',
                    ],
                    '粗利算出用原価単価' => [
                        'nullable',
                    ],
                    '税抜上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '税込上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '削除区分' => [
                        'nullable',
                        'in:0,1',
                    ],
                    'カラーコード1' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード2' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード3' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード4' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード5' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード6' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード7' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード8' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード9' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード10' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード11' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード12' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード13' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード14' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード15' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード16' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード17' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード18' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード19' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード20' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'サイズコード1' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード2' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード3' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード4' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード5' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード6' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード7' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード8' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード9' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード10' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'メンバーサイト商品コード' => [
                        'nullable',
                        'max:20',
                    ],
                    'メンバーサイト商品名' => [
                        'required',
                        'exclude_if:メンバーサイト商品コード, ""',
                        'max:30',
                    ],
                    'メンバーサイト連携区分' => [
                        'required',
                        'in:0,1,2',
                    ],
                ];
                // 更新
            } else {
                $rules = [
                    '商品コード' => [
                        'required',
                        //'max_digits:9'
                    ],
                    '他品番' => [
                        'nullable',
                        'max:20'
                    ],
                    '商品名' => [
                        'nullable',
                        'max:40'
                    ],
                    '名カナ' => [
                        'nullable',
                        'max:10'
                    ],
                    '単位名' => [
                        'nullable',
                        'max:4'
                    ],
                    '仕入先コード' => [
                        'nullable',
                        'digits:6',
                        'exists:mt_suppliers,supplier_cd'
                    ],
                    'ブランド1コード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '競技・カテゴリコード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    'ジャンルコード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '販売開始年コード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '工場分類5コード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '製品/工賃6コード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '資産在庫JAコード' => [
                        'nullable',
                        'exists:mt_item_classes,item_class_cd'
                    ],
                    '名称入力区分' => [
                        'nullable',
                        'in: 0,1'
                    ],
                    '在庫管理区分' => [
                        'nullable',
                        'in: 0,1'
                    ],
                    '非課税区分' => [
                        'nullable',
                        'in: 0,1'
                    ],
                    '税率区分' => [
                        'nullable',
                        'exists:def_tax_rate_kbns,tax_rate_kbn_cd'
                    ],
                    '商品区分' => [
                        'nullable',
                        'in: 0,1,2,4,6'
                    ],
                    '商品備考1' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考2' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考3' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考4' => [
                        'nullable',
                        'max:30',
                    ],
                    '商品備考5' => [
                        'nullable',
                        'max:30',
                    ],
                    '税抜参考上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '税込参考上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '税抜仕入単価' => [
                        'nullable',
                    ],
                    '税込仕入単価' => [
                        'nullable',
                    ],
                    '原価単価' => [
                        'nullable',
                    ],
                    '粗利算出用原価単価' => [
                        'nullable',
                    ],
                    '税抜上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '税込上代単価' => [
                        'nullable',
                        'numeric',
                    ],
                    '削除区分' => [
                        'nullable',
                        'in:0,1',
                    ],
                    'カラーコード1' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード2' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード3' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード4' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード5' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード6' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード7' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード8' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード9' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード10' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード11' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード12' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード13' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード14' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード15' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード16' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード17' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード18' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード19' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'カラーコード20' => [
                        'nullable',
                        'exists:mt_colors,color_cd',
                    ],
                    'サイズコード1' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード2' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード3' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード4' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード5' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード6' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード7' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード8' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード9' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'サイズコード10' => [
                        'nullable',
                        'exists:mt_sizes,size_cd',
                    ],
                    'メンバーサイト商品コード' => [
                        'nullable',
                        'max:20',
                    ],
                    'メンバーサイト商品名' => [
                        'required',
                        'exclude_if:メンバーサイト商品コード, ""',
                        'max:30',
                    ],
                    'メンバーサイト連携区分' => [
                        'nullable',
                        'in:0,1,2',
                    ],
                ];
            }
        } elseif ($target === '1') {
            $rules = [
                'JANコード' => [
                    'nullable',
                    'digits:13'
                ],
                '商品コード' => [
                    'required',
                    'max_digits:9'
                ],
                '他品番' => [
                    'nullable',
                    'max:20'
                ],
                '商品名' => [
                    'required',
                    'max:40'
                ],
                '名カナ' => [
                    'nullable',
                    'max:10'
                ],
                '単位名' => [
                    'nullable',
                    'max:4'
                ],
                'カラーコード' => [
                    'required',
                    'exists:mt_colors,color_cd',
                ],
                'サイズコード' => [
                    'required',
                    'exists:mt_sizes,size_cd',
                ],
                '仕入先コード' => [
                    'required',
                    'digits:6',
                    'exists:mt_suppliers,supplier_cd'
                ],
                'ブランド1コード' => [
                    'required',
                    'exists:mt_item_classes,item_class_cd'
                ],
                '競技・カテゴリコード' => [
                    'nullable',
                    'exists:mt_item_classes,item_class_cd'
                ],
                'ジャンルコード' => [
                    'nullable',
                    'exists:mt_item_classes,item_class_cd'
                ],
                '販売開始年コード' => [
                    'nullable',
                    'exists:mt_item_classes,item_class_cd'
                ],
                '工場分類5コード' => [
                    'nullable',
                    'exists:mt_item_classes,item_class_cd'
                ],
                '製品/工賃6コード' => [
                    'nullable',
                    'exists:mt_item_classes,item_class_cd'
                ],
                '資産在庫JAコード' => [
                    'nullable',
                    'exists:mt_item_classes,item_class_cd'
                ],
                '名称入力区分' => [
                    'nullable',
                    'in: 0,1'
                ],
                '在庫管理区分' => [
                    'nullable',
                    'in: 0,1'
                ],
                '非課税区分' => [
                    'nullable',
                    'in: 0,1'
                ],
                '税率区分' => [
                    'nullable',
                    'exists:def_tax_rate_kbns,tax_rate_kbn_cd'
                ],
                '商品区分' => [
                    'nullable',
                    'in:0,1,2,4,6'
                ],
                '商品備考1' => [
                    'nullable',
                    'max:30',
                ],
                '商品備考2' => [
                    'nullable',
                    'max:30',
                ],
                '商品備考3' => [
                    'nullable',
                    'max:30',
                ],
                '商品備考4' => [
                    'nullable',
                    'max:30',
                ],
                '商品備考5' => [
                    'nullable',
                    'max:30',
                ],
                '税抜参考上代単価' => [
                    'nullable',
                    'numeric',
                ],
                '税込参考上代単価' => [
                    'nullable',
                    'numeric',
                ],
                '税抜仕入単価' => [
                    'nullable',
                ],
                '税込仕入単価' => [
                    'nullable',
                ],
                '原価単価' => [
                    'nullable',
                ],
                '粗利算出用原価単価' => [
                    'nullable',
                ],
                '税抜上代単価' => [
                    'nullable',
                    'numeric',
                ],
                '税込上代単価' => [
                    'nullable',
                    'numeric',
                ],
                '削除区分' => [
                    'nullable',
                    'in:0,1',
                ],
                'メンバーサイト商品コード' => [
                    'nullable',
                    'max:20',
                ],
                'メンバーサイト商品名' => [
                    'required',
                    'exclude_if:メンバーサイト商品コード, ""',
                    'max:30',
                ],
                'メンバーサイト連携区分' => [
                    'required',
                    'in:0,1,2',
                ],
            ];
        }
        //品番
        if ($target === '0') {
            $attributes = [
                "商品コード" => "商品コード",
                "他品番" => "他品番",
                "商品名" => "商品名",
                "名カナ" => "名カナ",
                "単位名" => "単位名",
                "仕入先コード" => "仕入先コード",
                "ブランド1コード" => "ブランド1コード",
                "競技・カテゴリコード" => "競技・カテゴリコード",
                "ジャンルコード" => "ジャンルコード",
                "販売開始年コード" => "販売開始年コード",
                "工場分類5コード" => "工場分類5コード",
                "製品/工賃6コード" => "製品/工賃6コード",
                "資産在庫JAコード" => "資産在庫JAコード",
                "名称入力区分" => "名称入力区分",
                "在庫管理区分" => "在庫管理区分",
                "非課税区分" => "非課税区分",
                "税率区分" => "税率区分",
                "商品区分" => "商品区分",
                "商品備考1" => "商品備考1",
                "商品備考2" => "商品備考2",
                "商品備考3" => "商品備考3",
                "商品備考4" => "商品備考4",
                "商品備考5" => "商品備考5",
                "税抜参考上代単価" => "税抜参考上代単価",
                "税込参考上代単価" => "税込参考上代単価",
                "税抜仕入単価" => "税抜仕入単価",
                "税込仕入単価" => "税込仕入単価",
                "原価単価" => "原価単価",
                "粗利算出用原価単価" => "粗利算出用原価単価",
                "税抜上代単価" => "税抜上代単価",
                "税込上代単価" => "税込上代単価",
                "削除区分" => "削除区分",
                "カラーコード1" => "カラーコード1",
                "カラーコード2" => "カラーコード2",
                "カラーコード3" => "カラーコード3",
                "カラーコード4" => "カラーコード4",
                "カラーコード5" => "カラーコード5",
                "カラーコード6" => "カラーコード6",
                "カラーコード7" => "カラーコード7",
                "カラーコード8" => "カラーコード8",
                "カラーコード9" => "カラーコード9",
                "カラーコード10" => "カラーコード10",
                "カラーコード11" => "カラーコード11",
                "カラーコード12" => "カラーコード12",
                "カラーコード13" => "カラーコード13",
                "カラーコード14" => "カラーコード14",
                "カラーコード15" => "カラーコード15",
                "カラーコード16" => "カラーコード16",
                "カラーコード17" => "カラーコード17",
                "カラーコード18" => "カラーコード18",
                "カラーコード19" => "カラーコード19",
                "カラーコード20" => "カラーコード20",
                "サイズコード1" => "サイズコード1",
                "サイズコード2" => "サイズコード2",
                "サイズコード3" => "サイズコード3",
                "サイズコード4" => "サイズコード4",
                "サイズコード5" => "サイズコード5",
                "サイズコード6" => "サイズコード6",
                "サイズコード7" => "サイズコード7",
                "サイズコード8" => "サイズコード8",
                "サイズコード9" => "サイズコード9",
                "サイズコード10" => "サイズコード10",
                "メンバーサイト商品コード" => "メンバーサイト商品コード",
                "メンバーサイト商品名" => "メンバーサイト商品名",
                "メンバーサイト連携区分" => "メンバーサイト連携区分",
            ];
        } elseif ($target === '1') {
            $attributes = [
                "JANコード" => "JANコード",
                "商品コード" => "商品コード",
                "他品番" => "他品番",
                "商品名" => "商品名",
                "名カナ" => "名カナ",
                "単位名" => "単位名",
                "カラーコード" => "カラーコード",
                "サイズコード" => "サイズコード",
                "仕入先コード" => "仕入先コード",
                "ブランド1コード" => "ブランド1コード",
                "競技・カテゴリコード" => "競技・カテゴリコード",
                "ジャンルコード" => "ジャンルコード",
                "販売開始年コード" => "販売開始年コード",
                "工場分類5コード" => "工場分類5コード",
                "製品/工賃6コード" => "製品/工賃6コード",
                "資産在庫JAコード" => "資産在庫JAコード",
                "名称入力区分" => "名称入力区分",
                "在庫管理区分" => "在庫管理区分",
                "非課税区分" => "非課税区分",
                "税率区分" => "税率区分",
                "商品区分" => "商品区分",
                "商品備考1" => "商品備考1",
                "商品備考2" => "商品備考2",
                "商品備考3" => "商品備考3",
                "商品備考4" => "商品備考4",
                "商品備考5" => "商品備考5",
                "税抜参考上代単価" => "税抜参考上代単価",
                "税込参考上代単価" => "税込参考上代単価",
                "税抜仕入単価" => "税抜仕入単価",
                "税込仕入単価" => "税込仕入単価",
                "原価単価" => "原価単価",
                "粗利算出用原価単価" => "粗利算出用原価単価",
                "税抜上代単価" => "税抜上代単価",
                "税込上代単価" => "税込上代単価",
                "削除区分" => "削除区分",
                "メンバーサイト商品コード" => "メンバーサイト商品コード",
                "メンバーサイト商品名" => "メンバーサイト商品名",
                "メンバーサイト連携区分" => "メンバーサイト連携区分",
            ];
        }
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

    /** 商品  インポートファイルのDB更新
     * @param $params
     * @param $mode 0:新規/1:修正
     * @param $target 0:品番/1:SKU
     * @return $result
     */
    public function importUpdate($params, $mode, $target, $janMode)
    {
        $result = $this->mtItemRepository->importUpdate($params, $mode, $target, $janMode);
        return $result;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->mtItemRepository->getByCode($code);
        return $datas;
    }

    /** コード補完（SKU含む）(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoCompleteWithSKU($code)
    {
        $datas = $this->mtItemRepository->getByCodeWithSKU($code);
        return $datas;
    }

    public function getStockInfo($code)
    {
        $mt_item = $this->mtItemRepository->getByCode($code);
        $mt_stock_keeping_units = $this->mtStockKeepingUnitRepository->getDataByItemId($mt_item->id);
        return $mt_stock_keeping_units;
    }

    public function getStockKeepingUnit($item_cd, $color_cd, $size_cd)
    {
        $mt_item = $this->mtItemRepository->getByCode($item_cd);
        $mt_color = $this->mtColorRepository->getByCode($color_cd);
        $mt_size = $this->mtSizeRepository->getByCode($size_cd);
        $mt_stock_keeping_unit = $this->mtStockKeepingUnitRepository->getDataByItemColorSize($mt_item->id, $mt_color->id, $mt_size->id);
        return $mt_stock_keeping_unit;
    }
}
