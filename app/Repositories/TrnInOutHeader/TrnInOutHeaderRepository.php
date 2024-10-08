<?php

namespace App\Repositories\TrnInOutHeader;

use App\Models\TrnInOutHeader;
use App\Consts\CommonConsts;
use App\Models\DefInOutKbn;
use Illuminate\Support\Facades\Auth;
use App\Lib\CodeUtil;

class TrnInOutHeaderRepository implements TrnInOutHeaderRepositoryInterface
{

    /**
     * 商品データの条件取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $in_out_code = isset($params['in_out_code']) ? CodeUtil::pad($params['in_out_code'], 8) : null;
        $item_code = $params['item_code'] ?? null;

        $result = TrnInOutHeader::with(['mtWarehouseIssue', 'mtWarehousing', 'defInOutKbn', 'trnInOutDetails.mtItem']);

        $result->when($in_out_code, function ($query) use ($in_out_code) {
            return $query->where('in_out_number', '>=', $in_out_code);
        });

        $result->when($item_code, function ($query) use ($item_code) {
            return $query->whereHas('trnInOutDetails.mtItem', function ($query) use ($item_code) {
                $query->where("item_cd", 'like', "%$item_code%");
            });
        });

        $result->orderBy("in_out_number");

        return $result->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 商品データの条件取得
     * @param $params
     * @return Object
     */
    function updateInOutData($params)
    {
        // error_log(json_encode($params));
        // $data = [
        //     'id' => $params['trn_in_out_header']['id'],
        //     'in_out_number' => $params['trn_in_out_header']['in_out_number'] ?? $this->getNewInOutNumber(),
        //     'slip_date' => $params['trn_in_out_header']['order_date_year'] . '-' . $params['trn_in_out_header']['order_date_month'] . '-' . $params['trn_in_out_header']['order_date_day'],
        //     'mt_user_id' => $params['trn_in_out_header']['user_id'],
        //     'mt_warehouse_issue_id' => $params['trn_in_out_header']['warehouse_issue_id'],
        //     'mt_warehouse_warehousing_id' => $params['trn_in_out_header']['warehouse_warehousing_id'],
        //     'slip_memo' => $params['trn_in_out_header']['slip_memo'],
        //     'total_quantity' => $params['trn_in_out_header']['total_quantity'],
        //     'def_in_out_kbn_id' => $params['trn_in_out_header']['def_in_out_kbn_id'],
        //     'mt_user_last_update_id' => $params['trn_in_out_header']['user_id'],
        // ];

        // return TrnInOutHeader::updateOrCreate(['id' => $data['id']], $data);
        // $result = TrnInOutHeader::where('id', $params['trn_in_out_header']['id'])->first();
        // if ($result) {
        //     // Update TrnInOutHeader
        //     $result->update([
        //         'slip_date' => $params['trn_in_out_header']['order_date_year'] . '-' . $params['trn_in_out_header']['order_date_month'] . '-' . $params['trn_in_out_header']['order_date_day'],
        //         'mt_user_id' => $params['trn_in_out_header']['user_id'],
        //         'mt_warehouse_issue_id' => $params['trn_in_out_header']['warehouse_issue_id'],
        //         'mt_warehouse_warehousing_id' => $params['trn_in_out_header']['warehouse_warehousing_id'],
        //         'slip_memo' => $params['trn_in_out_header']['slip_memo'],
        //         'total_quantity' => $params['trn_in_out_header']['total_quantity'],
        //         'def_in_out_kbn_id' => $params['trn_in_out_header']['def_in_out_kbn_id'],
        //         'mt_user_last_update_id' => $params['trn_in_out_header']['user_id'],
        //     ]);

        //     // Update or create TrnInOutDetails
        //     foreach ($params['trn_in_out_details'] as $detailData) {
        //         $detail = $result->trnInOutDetails()->updateOrCreate(
        //             ['id' => $detailData['id'] ?? null],
        //             [
        //                 'mt_item_id' => $detailData['mt_item_id'],
        //                 'quantity' => $detailData['quantity'],
        //                 // Add other fields as necessary
        //             ]
        //         );

        //         // Update or create TrnInOutBreakdowns
        //         if (isset($detailData['breakdowns'])) {
        //             $breakdowns = json_decode($detailData['breakdowns'], true);
        //             foreach ($breakdowns as $breakdownData) {
        //                 $detail->trnInOutBreakdowns()->updateOrCreate(
        //                     ['id' => $breakdownData['id'] ?? null],
        //                     [
        //                         'mt_warehouse_id' => $breakdownData['mt_warehouse_id'],
        //                         'quantity' => $breakdownData['quantity'],
        //                         // Add other fields as necessary
        //                     ]
        //                 );
        //             }
        //         }
        //     }

        //     // Delete removed details and their breakdowns
        //     if (isset($params['deleted_details'])) {
        //         foreach ($params['deleted_details'] as $deletedDetailId) {
        //             $deletedDetail = $result->trnInOutDetails()->find($deletedDetailId);
        //             if ($deletedDetail) {
        //                 $deletedDetail->trnInOutBreakdowns()->delete();
        //                 $deletedDetail->delete();
        //             }
        //         }
        //     }
        // }
        // error_log($result);
        // return $result;
    }

    /**
     * 前頁
     * @param $id
     * @return Object
     */
    public function getPrevByCode($code)
    {
        // Show value of $code in the console
        if (isset($code['trn_in_out_header']['id'])) {
            $result = TrnInOutHeader::where('id', $code['trn_in_out_header']['id'] - 1)->first();
            error_log($result);
        } else {
            $result = TrnInOutHeader::orderBy('id')->first();
        }
        return $result;
    }

    /**
     * 次頁
     * @param $id
     * @return Object
     */
    public function getNextByCode($code)
    {
        // Show value of $code in the console
        if (isset($code['trn_in_out_header']['id'])) {
            $result = TrnInOutHeader::where('id', $code['trn_in_out_header']['id'] + 1)->first();
        } else {
            $result = TrnInOutHeader::orderBy('id')->first();
        }
        return $result;
    }
    /**
     * 削除
     * @param $id
     * @return Object
     */
    public function deleteByCode($code)
    {
        // Show value of $code in the console
        if (isset($code)) {
            $result = TrnInOutHeader::find($code);
            if ($result) {
                // Delete associated TrnInOutBreakdowns first
                foreach ($result->trnInOutDetails as $detail) {
                    $detail->trnInOutBreakdowns()->delete();
                }
                // Then delete associated TrnInOutDetails
                $result->trnInOutDetails()->delete();
                // Finally delete the TrnInOutHeader
                $result->delete();
            }
        } else {
            return;
        }
        return $result;
    }

    function getNewInOutNumber()
    {
        $result = intval(TrnInOutHeader::orderBy('in_out_number', 'desc')->first()->in_out_number);
        $result = $result + 1;
        $result = str_pad($result, 8, '0', STR_PAD_LEFT);
        return $result;
    }

    /**
     * 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = TrnInOutHeader::get();
        return $result;
    }

    /**
     * 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $result = TrnInOutHeader::where('in_out_number', $code)->with(['mtWarehouseIssue', 'mtWarehousing', 'defInOutKbn', 'trnInOutDetails.mtItem'])->first();
        return $result;
    }

    /**
     * 初期入出庫データ
     * @return Object
     */
    public function getInputDefaultData()
    {
        // 入力者
        $user_cd = Auth::user()->user_cd;
        $user_name = Auth::user()->user_name;
        $today = date('Y-m-d');
        $inout_date_year = date('Y', strtotime($today));
        $inout_date_month = date('m', strtotime($today));
        $inout_date_day = date('d', strtotime($today));

        $def_in_out_kbn_ids = DefInOutKbn::all()->pluck('in_out_kbn_name', 'id');
        $lastInOutHeader = TrnInOutHeader::orderBy('in_out_number', 'desc')->first();
        if ($lastInOutHeader) {
            $currentNumber = intval($lastInOutHeader->in_out_number);
            $newNumber = $currentNumber + 1;
            $newInOutNumber = str_pad($newNumber, 8, '0', STR_PAD_LEFT);
        }

        $data = [
            'user_id' => Auth::id(),
            'user_cd' => $user_cd,
            'user_name' => $user_name,
            'def_in_out_kbn_ids' => $def_in_out_kbn_ids,
            'def_in_out_kbn_id' => 0,
            'in_out_number' => $newInOutNumber,
            'inout_date_year' => $inout_date_year,
            'inout_date_month' => $inout_date_month,
            'inout_date_day' => $inout_date_day,
            'trn_in_out_details' => ''
        ];

        return $data;
    }
    /**
     * ID入出庫データ
     * @param $id
     * @return Object
     */
    public function getInputDefaultDataById($id)
    {
        $data = TrnInOutHeader::where('id', $id)->with(['mtWarehouseIssue', 'mtWarehousing', 'defInOutKbn', 'trnInOutDetails.mtItem'])->first();
        $def_in_out_kbn_ids = DefInOutKbn::all()->pluck('in_out_kbn_name', 'id');

        // 入力者
        $user_cd = Auth::user()->user_cd;
        $user_name = Auth::user()->user_name;
        $slip_date = $data->slip_date;
        $inout_date_year = date('Y', strtotime($slip_date));
        $inout_date_month = date('m', strtotime($slip_date));
        $inout_date_day = date('d', strtotime($slip_date));
        $warehouse_issue_cd = $data->mtWarehouseIssue ? $data->mtWarehouseIssue->warehouse_cd : '';
        $warehouse_issue_name = $data->mtWarehouseIssue ? $data->mtWarehouseIssue->warehouse_name : '';
        $warehouse_issue_id = $data->mtWarehouseIssue ? $data->mtWarehouseIssue : '';
        $warehouse_warehousing_cd = $data->mtWarehousing ? $data->mtWarehousing->warehouse_cd : '';
        $warehouse_warehousing_name = $data->mtWarehousing ? $data->mtWarehousing->warehouse_name : '';
        $warehouse_warehousing_id = $data->mtWarehousing ? $data->mt_warehouse_warehousing_id : '';
        $data = [
            'id' => $data->id,
            'user_id' => Auth::id(),
            'user_cd' => $user_cd,
            'user_name' => $user_name,
            'def_in_out_kbn_id' => $data->def_in_out_kbn_id,
            'in_out_number' => $data->in_out_number,
            'def_in_out_kbn_ids' => $def_in_out_kbn_ids,
            'inout_date_year' => $inout_date_year,
            'inout_date_month' => $inout_date_month,
            'inout_date_day' => $inout_date_day,
            'warehouse_issue_cd' => $warehouse_issue_cd,
            'warehouse_issue_name' => $warehouse_issue_name,
            'warehouse_issue_id' => $warehouse_issue_id,
            'warehouse_warehousing_cd' => $warehouse_warehousing_cd,
            'warehouse_warehousing_name' => $warehouse_warehousing_name,
            'warehouse_warehousing_id' => $warehouse_warehousing_id,
            'trn_in_out_details' => $data->trnInOutDetails,
        ];

        return $data;
    }


    /**
     * 入出庫チェックリストの情報取得
     * @param array $params
     * @return Object
     */
    public function getInoutChecklist(array $params)
    {
        /*
                        'date_year_start' => 'nullable',
                'date_month_start' => 'nullable',
                'date_day_start' => 'nullable',
                'date_year_end' => 'nullable',
                'date_month_end' => 'nullable',
                'date_day_end' => 'nullable',
                'process_kbn' => 'nullable',
                'user_cd_start' => 'nullable',
                'user_cd_end' => 'nullable',
                'warehouse_cd_start' => 'nullable',
                'warehouse_cd_end' => 'nullable',
                'in_out_kbn_cd' => 'nullable',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'in_out_number_start' => 'nullable',
                'in_out_number_end' => 'nullable',
            */
        $result = TrnInOutHeader::get();
        return $result;
    }

    /**
     * 商品別倉庫別在庫一覧表の情報取得
     * @param array $params
     * @return Object
     */
    public function getWarehouseList(array $params)
    {
        $result = TrnInOutHeader::get();
        return $result;
    }

    /**
     * 在庫データ書き出しの情報取得
     * @param array $params
     * @return Object
     */
    public function getDataOutput(array $params)
    {
        $result = TrnInOutHeader::get();
        return $result;
    }

    /**
     * 在庫一覧表の情報取得
     * @param array $params
     * @return Object
     */
    public function getList(array $params)
    {
        $result = TrnInOutHeader::get();
        return $result;
    }

    /**
     * 入出庫データの更新
     * @param array $params
     * @return Object
     */
    public function updateInOutDataImport(array $params)
    {
        $result = TrnInOutHeader::get();
        return $result;
    }

    /**
     * 入出庫データの情報取得
     * @param array $params
     * @return Object
     */
    public function getInOutDataImport(array $params)
    {
        $result = TrnInOutHeader::get();
        return $result;
    }
}
