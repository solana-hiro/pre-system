<?php
namespace App\Repositories\TrnOrderReceiveHeader;

use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use App\Models\TrnOrderReceiveHeader;
use App\Models\TrnOrderReceiveDetail;
use App\Models\MtManager;
use App\Models\MtCustomer;
use App\Models\MtDeliveryDestination;
use App\Models\MtUser;
use App\Models\MtRoot;
use App\Models\MtOrderReceiveStickyNote;
use App\Models\TrnOrderHeader;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class TrnOrderReceiveHeaderRepository implements TrnOrderReceiveHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnOrderReceiveHeader::get();
		return $result;
    }

    public function get($params)
    {
        $order_receive_number = $params['order_receive_number'] ? CodeUtil::pad($params['order_receive_number'], 8) : null;
        $customer_cd = $params['customer_cd'] ? CodeUtil::pad($params['customer_cd'], 6) : null;
        $order_number = $params['order_number'] ? CodeUtil::pad($params['order_number'], 15) : null;

        $query = TrnOrderReceiveHeader::query();
        $query->select(
            'trn_order_receive_headers.order_receive_number as order_receive_number',
            'trn_order_receive_headers.order_receive_date as order_receive_date',
            'mt_customers.customer_cd as customer_cd',
            'trn_order_receive_headers.customer_name as customer_name',
            'trn_order_receive_headers.quantity_total as quantity_total',
            'trn_order_receive_headers.order_number as order_number',
            'trn_order_receive_headers.ec_order_receive_number as ec_order_receive_number',
        );
        $query->leftJoin('mt_customers', 'trn_order_receive_headers.mt_customer_id', 'mt_customers.id');
        $query->when($order_receive_number, fn($query) => $query->where("trn_order_receive_headers.order_receive_number", '>=', $order_receive_number));
        // mtCustomerのcustomer_cdで検索
        $query->when($customer_cd, fn($query) => $query->where("mt_customers.customer_cd", $customer_cd));
        // order_numberは部分一致検索
        $query->when($order_number, fn($query) => $query->where("trn_order_receive_headers.order_number", 'like', "%$order_number%"));
        $query->orderBy('trn_order_receive_headers.order_receive_number');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 受注ヘッダの最終受注番号取得
     * @return mixed
    */
    public function getAccountantDefaultData() {
        $order_receive_header = TrnOrderReceiveHeader::orderByDesc('order_receive_number')->first();
        $order_receive_number = $order_receive_header->order_receive_number + 1;
        // 今日の日付
        $order_date_year = date('Y');
        $order_date_month = date('m');
        $order_date_day = date('d');
        // 入力者
        $user_cd = Auth::user()->id;
        $user_name = Auth::user()->user_name;

        $mt_order_receive_sticky_notes = MtOrderReceiveStickyNote::where('def_sticky_note_kind_id', 2)->whereNotNull('sticky_note_name')->get();

        $data = [
            'order_receive_number' => $order_receive_number,
            'order_date_year' => $order_date_year,
            'order_date_month' => $order_date_month,
            'order_date_day' => $order_date_day,
            'user_cd' => $user_cd,
            'user_name' => $user_name,
            'mt_order_receive_sticky_notes' => $mt_order_receive_sticky_notes,
        ];

        return $data;
    }

    public function getByReceiveNumber($receive_number)
    {
        return TrnOrderReceiveHeader::where('order_receive_number', $receive_number)->first();
    }

    /**
     * 受注問合せの情報取得
     * @param array $params
     * @return Object
     */
     public function getAccountantInquiry(array $params) {
        $result = null;
        //日付フォーマット
        $startDate = Carbon::createFromFormat('Y-m-d', $params['start_date_y'] . "-" . $params['start_date_m'] . "-" . $params['start_date_d']);
        $endDate = Carbon::createFromFormat('Y-m-d', $params['end_date_y'] . "-" . $params['end_date_m'] . "-" . $params['end_date_d']);
        //code変換
        $itemCode = ($params['item_code']) ? $params['item_code'] : null;
        $customerCode = ($params['customer_code']) ? str_pad($params['customer_code'], 6, 0, STR_PAD_LEFT) : null;
        $orderByColumn = $params['sort_order'] === '0' ? 'order_receive_date' : 'specify_deadline';
        $result = TrnOrderReceiveHeader::select(
            'trn_order_receive_headers.id as id',
            'trn_order_receive_headers.order_receive_date as order_receive_date',
            'trn_order_receive_details.specify_deadline as specify_deadline',
            'trn_order_receive_headers.order_receive_number as order_receive_number',
            'trn_order_receive_headers.settlement_method as settlement_method',
            'mt_customers.customer_cd as customer_cd',
            'mt_customers.customer_name as customer_name',
            'mt_items.item_cd as item_cd',
            'mt_items.item_name as item_name',
            'mt_colors.color_cd as color_cd',
            'mt_colors.color_name as color_name',
            'mt_sizes.size_cd as size_cd',
            'mt_sizes.size_name as size_name',
            'trn_order_receive_details.order_receive_quantity as trn_order_receive_details_order_receive_quantity',
            'trn_order_receive_details.order_receive_price as order_receive_price',
            'trn_sale_breakdowns.order_receive_quantity as trn_sale_breakdowns_order_receive_quantity',
            'trn_order_receive_breakdowns.order_receive_quantity as trn_order_receive_breakdowns_order_receive_quantity',
            'trn_order_receive_headers.order_number as order_number',
            'trn_order_receive_details.order_receive_finish_flg as order_receive_finish_flg',
            'mt_delivery_destinations.delivery_destination_id as delivery_destination_id',
            'mt_delivery_destinations.delivery_destination_name as delivery_destination_name',
        )->leftJoin('trn_order_receive_details', 'trn_order_receive_headers.id', 'trn_order_receive_details.trn_order_receive_header_id')
            ->leftJoin('trn_order_receive_breakdowns', 'trn_order_receive_details.id', 'trn_order_receive_breakdowns.trn_order_receive_detail_id')
            ->leftJoin('mt_customers', 'trn_order_receive_headers.mt_customer_id', 'mt_customers.id')
            ->leftJoin('mt_items', 'trn_order_receive_details.mt_item_id', 'mt_items.id')
            ->leftJoin('mt_stock_keeping_units', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id')
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->leftJoin('mt_delivery_destinations', 'trn_order_receive_headers.mt_delivery_destination_id', 'mt_delivery_destinations.id')
            ->leftJoin('trn_sale_breakdowns', 'mt_stock_keeping_units.id', 'trn_sale_breakdowns.mt_stock_keeping_unit_id')
            ->when(isset($startDate), function ($query) use ($startDate, $endDate) {
                return $query->where(function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween("order_receive_date", [$startDate, $endDate]);
                });
            })->when(
                isset($params['item_code']) && !empty($params['item_code']),
                function ($query) use ($itemCode) {
                    return $query->where(function ($query) use ($itemCode) {
                        return $query->where("item_cd", '=', $itemCode);
                    });
            })->when(
                isset($params['customer_code']) && !empty($params['customer_code']),
                function ($query) use ($customerCode) {
                    return $query->where(function ($query) use ($customerCode) {
                        return $query->where("mt_customers.customer_cd", '=', $customerCode);
                    });
            })->when(
                isset($params['customer_name_like']) && !empty($params['customer_name_like']),
                function ($query) use ($params) {
                    return $query->where(function ($query) use ($params) {
                        return $query->where("mt_customers.customer_name", 'like', '%'. $params['customer_name_like'].'%');
                    });
            })->when(
                isset($params['delivery_destination_name_like']) && !empty($params['delivery_destination_name_like']),
                function ($query) use ($params) {
                    return $query->where(function ($query) use ($params) {
                        return $query->where("mt_delivery_destinations.delivery_destination_name", 'like', '%' . $params['delivery_destination_name_like'] . '%');
                    });
            })->when(
                isset($params['complete_kbn']) && ($params['complete_kbn'] === '0' || $params['complete_kbn'] === '1'),
                function ($query) use ($params) {
                    return $query->where(function ($query) use ($params) {
                        return $query->where("order_receive_finish_flg", $params['complete_kbn']);
                    });
            })->when(
                isset($params['settlement_method']) && ($params['settlement_method'] === '0' || $params['settlement_method'] === '1'),
                function ($query) use ($params) {
                    return $query->where(function ($query) use ($params) {
                        return $query->where("settlement_method", $params['settlement_method']);
                    });
            })->when(
                isset($params['sort_order']),
                function ($query) use ($orderByColumn) {
                    return $query->where(function ($query) use ($orderByColumn) {
                        return $query->orderBy("{$orderByColumn}");
                    });
            })->limit($params['rec_count'])->get();
            return $result;
     }

    /**)->when(
                isset($params['customer_code']),
                function ($query) use ($customerCode) {
                    return $query->where(function ($query) use ($customerCode) {
                        return $query->where("customer_cd", '=', $customerCode);
                    });

     * 入出荷予定問合せの取得　DELETE
     * @param array $params
     * @return Object
     */
    /*
     public function getShippingInquiry(array $params) {
        $result = null;
        //日付フォーマット
        $startDate = Carbon::createFromFormat('Y-m-d', $params['start_date_y'] . "-" . $params['start_date_m'] . "-" . $params['start_date_d']);
        $endDate = Carbon::createFromFormat('Y-m-d', $params['end_date_y'] . "-" . $params['end_date_m'] . "-" . $params['end_date_d']);
        //code変換
        $startItemCode = ($params['start_item_code']) ? str_pad($params['start_item_code'], 9, 0, STR_PAD_LEFT) : '';
        $endItemCode = ($params['end_item_code']) ? str_pad($params['end_item_code'], 9, 0, STR_PAD_LEFT) : 'ZZZZZZZZZ';
        $startColorCode = ($params['start_color_code']) ? str_pad($params['start_color_code'], 5, 0, STR_PAD_LEFT) : '';
        $endColorCode = ($params['end_color_code']) ? str_pad($params['end_color_code'], 5, 0, STR_PAD_LEFT) : 'ZZZZZ';
        $startSizeCode = ($params['start_size_code']) ? str_pad($params['start_size_code'], 5, 0, STR_PAD_LEFT) : '';
        $endSizeCode = ($params['end_size_code']) ? str_pad($params['end_size_code'], 5, 0, STR_PAD_LEFT) : 'ZZZZZ';
        $startWarehouseCode = ($params['start_warehouse_code']) ? str_pad($params['start_warehouse_code'], 6, 0, STR_PAD_LEFT) : '';
        $endWarehouseCode = ($params['end_warehouse_code']) ? str_pad($params['end_warehouse_code'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';



        if ($params['target'] === '1') {
            //受注のみ
            $target1Data = TrnOrderReceiveHeader::select(
                'trn_order_receive_details.id as id',
                'mt_items.item_cd as item_cd',
                'mt_items.item_name as item_name',
            )->leftJoin('trn_order_receive_details', 'trn_order_receive_headers.id', 'trn_order_receive_details.trn_order_receive_header_id')
            ->leftJoin('mt_warehouses', 'trn_order_receive_headers.mt_warehouses_id', 'mt_warehouses.id')
            ->leftJoin('trn_order_receive_breakdowns', 'trn_order_receive_details.id', 'trn_order_receive_breakdowns.trn_order_receive_detail_id')
            ->leftJoin('mt_stock_keeping_units', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id')
            ->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->leftJoin('trn_order_breakdowns', 'mt_stock_keeping_units.id', 'trn_order_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_stocks', 'mt_stock_keeping_units.id', 'mt_stocks.mt_stock_keeping_unit_id')
            ->leftJoin('mt_customers', 'trn_order_receive_headers.mt_customer_id', 'mt_customers.id')
            ->when(isset($startDate), function ($query) use ($startDate, $endDate) {
                return $query->where(function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween("order_receive_date", [$startDate, $endDate]);
                });
            })->when(isset($params['start_item_code']), function ($query) use ($startItemCode) {
                return $query->where(function ($query) use ($startItemCode) {
                    return $query->where("item_cd", '>=', $startItemCode);
                });
            })->when(isset($params['end_item_code']), function ($query) use ($endItemCode) {
                return $query->where(function ($query) use ($endItemCode) {
                    return $query->where("item_cd", '<=', $endItemCode);
                });
            })->when(isset($params['start_color_code']), function ($query) use ($startColorCode) {
                return $query->where(function ($query) use ($startColorCode) {
                    return $query->where("color_cd", '>=', $startColorCode);
                });
            })->when(isset($params['end_color_code']), function ($query) use ($endColorCode) {
                return $query->where(function ($query) use ($endColorCode) {
                    return $query->where("color_cd", '<=', $endColorCode);
                });
            })->when(isset($params['start_size_code']), function ($query) use ($startSizeCode) {
                return $query->where(function ($query) use ($startSizeCode) {
                    return $query->where("size_cd", '>=', $startSizeCode);
                });
            })->when(isset($params['end_size_code']), function ($query) use ($endSizeCode) {
                return $query->where(function ($query) use ($endSizeCode) {
                    return $query->where("size_cd", '<=', $endSizeCode);
                });
            })->when(isset($params['start_warehouse_code']), function ($query) use ($startWarehouseCode) {
                return $query->where(function ($query) use ($startWarehouseCode) {
                    return $query->where("warehouse_cd", '>=', $startWarehouseCode);
                });
            })->when(isset($params['end_warehouse_code']), function ($query) use ($endWarehouseCode) {
                return $query->where(function ($query) use ($endWarehouseCode) {
                    return $query->where("warehouse_cd", '<=', $endWarehouseCode);
                });
            })->orderBy('item_cd')->orderBy('color_cd')->orderBy('size_cd')
            ->get();
            $result = $target1Data;
        } elseif ($params['target'] === '2') {
            //発注のみ
        }

        // 全て
        if ($params['target'] === '0') {
            //merge: $target1Data, $target2Data
        }
        return $result;
     }
     */

    /**
     * 入出荷予定問合せの検索・出力内容取得
     * @param array $params
     * @return Object
     */
     public function getShippingInquiry($params) {
        $result = null;
        //日付フォーマット
        $startDate = Carbon::createFromFormat('Y-m-d', $params['start_date_y'] . "-" . $params['start_date_m'] . "-" . $params['start_date_d']);
        $endDate = Carbon::createFromFormat('Y-m-d', $params['end_date_y'] . "-" . $params['end_date_m'] . "-" . $params['end_date_d']);
        //code変換
        $startItemCode = ($params['start_item_code']) ? $params['start_item_code'] : '';
        $endItemCode = ($params['end_item_code']) ? $params['end_item_code'] : 'ZZZZZZZZZ';
        $startColorCode = ($params['start_color_code']) ? $params['start_color_code'] : '';
        $endColorCode = ($params['end_color_code']) ? $params['end_color_code'] : 'ZZZZZ';
        $startSizeCode = ($params['start_size_code']) ? $params['start_size_code'] : '';
        $endSizeCode = ($params['end_size_code']) ? $params['end_size_code'] : 'ZZZZZ';
        $startWarehouseCode = ($params['start_warehouse_code']) ? str_pad($params['start_warehouse_code'], 6, 0, STR_PAD_LEFT) : '';
        $endWarehouseCode = ($params['end_warehouse_code']) ? str_pad($params['end_warehouse_code'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';

        /*
        $startItemId = MtItem::where('item_cd', $startItemCode)->first()->pluck('id');
        $endItemId = MtItem::where('item_cd', $endItemCode)->first()->pluck('id');
        $startColorId = MtColor::where('color_cd', $startColorCode)->first()->pluck('id');
        $endColorId = MtColor::where('color_cd', $endColorCode)->first()->pluck('id');
        $startSizeId = MtSize::where('size_cd', $startSizeCode)->first()->pluck('id');
        $endSizeId =  MtSize::where('size_cd', $endSizeCode)->first()->pluck('id');
        $startWarehouseId = MtWarehouse::where('warehouse_cd', $startWarehouseCode)->first()->pluck('id');
        $endWarehouseId = MtWarehouse::where('warehouse_cd', $endWarehouseCode)->first()->pluck('id');
        */

        if ($params['target'] === '1') {
            //受注のみ
            $target1Data = TrnOrderReceiveHeader::select(
                'trn_order_receive_headers.id as id',
                'mt_items.item_cd as item_cd',
                'mt_items.item_name as item_name',
                'mt_colors.color_cd as color_cd',
                'mt_colors.color_name as color_name',
                'mt_sizes.size_cd as size_cd',
                'mt_sizes.size_name as size_name',
                'trn_order_receive_details.specify_deadline as deadline',
                'trn_order_details.order_quantity as order_quantity',
                'trn_order_receive_details.order_receive_quantity as order_receive_quantity',
                'mt_stocks.now_stock_quantity as now_stock_quantity',
                'trn_order_receive_headers.order_receive_number as number',
                'trn_order_receive_details.id as line_no',
                'trn_order_receive_headers.order_receive_date as order_date',
                'mt_customers.customer_cd as cs_cd',
                'mt_customers.customer_name as cs_name',
                'trn_order_receive_headers.order_number as order_number',
                'mt_warehouses.warehouse_cd as warehouse_cd',
                'mt_warehouses.warehouse_name as warehouse_name',
            )->leftJoin('trn_order_receive_details', 'trn_order_receive_headers.id', 'trn_order_receive_details.trn_order_receive_header_id')
            ->leftJoin('mt_warehouses', 'trn_order_receive_headers.mt_warehouse_id', 'mt_warehouses.id')
            ->leftJoin('trn_order_receive_breakdowns', 'trn_order_receive_details.id', 'trn_order_receive_breakdowns.trn_order_receive_detail_id')
            ->leftJoin('mt_stock_keeping_units', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id')
            ->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->leftJoin('trn_order_breakdowns', 'mt_stock_keeping_units.id', 'trn_order_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('trn_order_details', 'trn_order_breakdowns.trn_order_detail_id', 'trn_order_details.id')
            ->leftJoin('mt_stocks', 'mt_stock_keeping_units.id', 'mt_stocks.mt_stock_keeping_unit_id')
            ->leftJoin('mt_customers', 'trn_order_receive_headers.mt_customer_id', 'mt_customers.id')
            ->when(isset($startDate), function ($query) use ($startDate, $endDate) {
                return $query->where(function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween("order_receive_date", [$startDate, $endDate]);
                });
            })->when(isset($params['start_item_code']), function ($query) use ($startItemCode) {
                return $query->where(function ($query) use ($startItemCode) {
                    return $query->where("item_cd", '>=', $startItemCode);
                });
            })->when(isset($params['end_item_code']), function ($query) use ($endItemCode) {
                return $query->where(function ($query) use ($endItemCode) {
                    return $query->where("item_cd", '<=', $endItemCode);
                });
            })->when(isset($params['start_color_code']), function ($query) use ($startColorCode) {
                return $query->where(function ($query) use ($startColorCode) {
                    return $query->where("color_cd", '>=', $startColorCode);
                });
            })->when(isset($params['end_color_code']), function ($query) use ($endColorCode) {
                return $query->where(function ($query) use ($endColorCode) {
                    return $query->where("color_cd", '<=', $endColorCode);
                });
            })->when(isset($params['start_size_code']), function ($query) use ($startSizeCode) {
                return $query->where(function ($query) use ($startSizeCode) {
                    return $query->where("size_cd", '>=', $startSizeCode);
                });
            })->when(isset($params['end_size_code']), function ($query) use ($endSizeCode) {
                return $query->where(function ($query) use ($endSizeCode) {
                    return $query->where("size_cd", '<=', $endSizeCode);
                });
            })->when(isset($params['start_warehouse_code']), function ($query) use ($startWarehouseCode) {
                return $query->where(function ($query) use ($startWarehouseCode) {
                    return $query->where("warehouse_cd", '>=', $startWarehouseCode);
                });
            })->when(isset($params['end_warehouse_code']), function ($query) use ($endWarehouseCode) {
                return $query->where(function ($query) use ($endWarehouseCode) {
                    return $query->where("warehouse_cd", '<=', $endWarehouseCode);
                });
            })->orderBy('item_cd')->orderBy('color_cd')->orderBy('size_cd')
            ->get();
            $result = $target1Data;
            return $result;
        } elseif ($params['target'] === '2') {
            //発注のみ
            $target2Data = TrnOrderHeader::select(
                'trn_order_headers.id as id',
                'mt_items.item_cd as item_cd',
                'mt_items.item_name as item_name',
                'mt_colors.color_cd as color_cd',
                'mt_colors.color_name as color_name',
                'mt_sizes.size_cd as size_cd',
                'mt_sizes.size_name as size_name',
                'trn_order_headers.specify_deadline as deadline',
                'trn_order_details.order_quantity as order_quantity',
                'trn_order_receive_details.order_receive_quantity as order_receive_quantity',
                'mt_stocks.now_stock_quantity as now_stock_quantity',
                'trn_order_headers.order_number as number',
                'trn_order_details.id as line_no',
                'trn_order_headers.order_date as order_date',
                'mt_suppliers.supplier_cd as cs_cd',
                'mt_suppliers.supplier_name as cs_name',
                'trn_order_headers.order_number as order_number',
                'mt_warehouses.warehouse_cd as warehouse_cd',
                'mt_warehouses.warehouse_name as warehouse_name',
            )->leftJoin('trn_order_details', 'trn_order_headers.id', 'trn_order_details.trn_order_header_id')
                ->leftJoin('mt_warehouses', 'trn_order_headers.mt_warehouse_id', 'mt_warehouses.id')
                ->leftJoin('trn_order_breakdowns', 'trn_order_details.id', 'trn_order_breakdowns.trn_order_detail_id')
                ->leftJoin('mt_stock_keeping_units', 'trn_order_breakdowns.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id')
                ->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
                ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
                ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
                ->leftJoin('mt_stocks', 'mt_stock_keeping_units.id', 'mt_stocks.mt_stock_keeping_unit_id')
                ->leftJoin('mt_suppliers', 'trn_order_headers.mt_supplier_id', 'mt_suppliers.id')
                ->leftJoin('trn_order_receive_breakdowns', 'mt_stock_keeping_units.id', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id')
                ->leftJoin('trn_order_receive_details', 'trn_order_receive_breakdowns.trn_order_receive_detail_id', 'trn_order_receive_details.id')
                ->when(isset($startDate), function ($query) use ($startDate, $endDate) {
                    return $query->where(function ($query) use ($startDate, $endDate) {
                        return $query->whereBetween("order_date", [$startDate, $endDate]);
                    });
                })->when(isset($params['start_item_code']), function ($query) use ($startItemCode) {
                    return $query->where(function ($query) use ($startItemCode) {
                        return $query->where("item_cd", '>=', $startItemCode);
                    });
                })->when(isset($params['end_item_code']), function ($query) use ($endItemCode) {
                    return $query->where(function ($query) use ($endItemCode) {
                        return $query->where("item_cd", '<=', $endItemCode);
                    });
                })->when(isset($params['start_color_code']), function ($query) use ($startColorCode) {
                    return $query->where(function ($query) use ($startColorCode) {
                        return $query->where("color_cd", '>=', $startColorCode);
                    });
                })->when(isset($params['end_color_code']), function ($query) use ($endColorCode) {
                    return $query->where(function ($query) use ($endColorCode) {
                        return $query->where("color_cd", '<=', $endColorCode);
                    });
                })->when(isset($params['start_size_code']), function ($query) use ($startSizeCode) {
                    return $query->where(function ($query) use ($startSizeCode) {
                        return $query->where("size_cd", '>=', $startSizeCode);
                    });
                })->when(isset($params['end_size_code']), function ($query) use ($endSizeCode) {
                    return $query->where(function ($query) use ($endSizeCode) {
                        return $query->where("size_cd", '<=', $endSizeCode);
                    });
                })->when(isset($params['start_warehouse_code']), function ($query) use ($startWarehouseCode) {
                    return $query->where(function ($query) use ($startWarehouseCode) {
                        return $query->where("warehouse_cd", '>=', $startWarehouseCode);
                    });
                })->when(isset($params['end_warehouse_code']), function ($query) use ($endWarehouseCode) {
                    return $query->where(function ($query) use ($endWarehouseCode) {
                        return $query->where("warehouse_cd", '<=', $endWarehouseCode);
                    });
                })->orderBy('item_cd')->orderBy('color_cd')->orderBy('size_cd')
                ->get();
            $result = $target2Data;
            return $result;
        }

        // 全て
        if ($params['target'] === '0') {
            //merge: $target1Data, $target2Data
            //受注のみ
            $target1Data = TrnOrderReceiveHeader::select(
                'trn_order_receive_headers.id as id',
                'mt_items.item_cd as item_cd',
                'mt_items.item_name as item_name',
                'mt_colors.color_cd as color_cd',
                'mt_colors.color_name as color_name',
                'mt_sizes.size_cd as size_cd',
                'mt_sizes.size_name as size_name',
                'trn_order_receive_details.specify_deadline as deadline',
                'trn_order_details.order_quantity as order_quantity',
                'trn_order_receive_details.order_receive_quantity as order_receive_quantity',
                'mt_stocks.now_stock_quantity as now_stock_quantity',
                'trn_order_receive_headers.order_receive_number as number',
                'trn_order_receive_details.id as line_no',
                'trn_order_receive_headers.order_receive_date as order_date',
                'mt_customers.customer_cd as cs_cd',
                'mt_customers.customer_name as cs_name',
                'trn_order_receive_headers.order_number as order_number',
                'mt_warehouses.warehouse_cd as warehouse_cd',
                'mt_warehouses.warehouse_name as warehouse_name',
            )->leftJoin('trn_order_receive_details', 'trn_order_receive_headers.id', 'trn_order_receive_details.trn_order_receive_header_id')
                ->leftJoin('mt_warehouses', 'trn_order_receive_headers.mt_warehouse_id', 'mt_warehouses.id')
                ->leftJoin('trn_order_receive_breakdowns', 'trn_order_receive_details.id', 'trn_order_receive_breakdowns.trn_order_receive_detail_id')
                ->leftJoin('mt_stock_keeping_units', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id')
                ->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
                ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
                ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
                ->leftJoin('trn_order_breakdowns', 'mt_stock_keeping_units.id', 'trn_order_breakdowns.mt_stock_keeping_unit_id')
                ->leftJoin('trn_order_details', 'trn_order_breakdowns.trn_order_detail_id', 'trn_order_details.id')
                ->leftJoin('mt_stocks', 'mt_stock_keeping_units.id', 'mt_stocks.mt_stock_keeping_unit_id')
                ->leftJoin('mt_customers', 'trn_order_receive_headers.mt_customer_id', 'mt_customers.id')
                ->when(isset($startDate), function ($query) use ($startDate, $endDate) {
                    return $query->where(function ($query) use ($startDate, $endDate) {
                        return $query->whereBetween("order_receive_date", [$startDate, $endDate]);
                    });
                })->when(isset($params['start_item_code']), function ($query) use ($startItemCode) {
                    return $query->where(function ($query) use ($startItemCode) {
                        return $query->where("item_cd", '>=', $startItemCode);
                    });
                })->when(isset($params['end_item_code']), function ($query) use ($endItemCode) {
                    return $query->where(function ($query) use ($endItemCode) {
                        return $query->where("item_cd", '<=', $endItemCode);
                    });
                })->when(isset($params['start_color_code']), function ($query) use ($startColorCode) {
                    return $query->where(function ($query) use ($startColorCode) {
                        return $query->where("color_cd", '>=', $startColorCode);
                    });
                })->when(isset($params['end_color_code']), function ($query) use ($endColorCode) {
                    return $query->where(function ($query) use ($endColorCode) {
                        return $query->where("color_cd", '<=', $endColorCode);
                    });
                })->when(isset($params['start_size_code']), function ($query) use ($startSizeCode) {
                    return $query->where(function ($query) use ($startSizeCode) {
                        return $query->where("size_cd", '>=', $startSizeCode);
                    });
                })->when(isset($params['end_size_code']), function ($query) use ($endSizeCode) {
                    return $query->where(function ($query) use ($endSizeCode) {
                        return $query->where("size_cd", '<=', $endSizeCode);
                    });
                })->when(isset($params['start_warehouse_code']), function ($query) use ($startWarehouseCode) {
                    return $query->where(function ($query) use ($startWarehouseCode) {
                        return $query->where("warehouse_cd", '>=', $startWarehouseCode);
                    });
                })->when(isset($params['end_warehouse_code']), function ($query) use ($endWarehouseCode) {
                    return $query->where(function ($query) use ($endWarehouseCode) {
                        return $query->where("warehouse_cd", '<=', $endWarehouseCode);
                    });
                })->orderBy('item_cd')->orderBy('color_cd')->orderBy('size_cd')
                ->get();

            //発注のみ
            $target2Data = TrnOrderHeader::select(
                'trn_order_headers.id as id',
                'mt_items.item_cd as item_cd',
                'mt_items.item_name as item_name',
                'mt_colors.color_cd as color_cd',
                'mt_colors.color_name as color_name',
                'mt_sizes.size_cd as size_cd',
                'mt_sizes.size_name as size_name',
                'trn_order_headers.specify_deadline as deadline',
                'trn_order_details.order_quantity as order_quantity',
                'trn_order_receive_details.order_receive_quantity as order_receive_quantity',
                'mt_stocks.now_stock_quantity as now_stock_quantity',
                'trn_order_headers.order_number as number',
                'trn_order_details.id as line_no',
                'trn_order_headers.order_date as order_date',
                'mt_suppliers.supplier_cd as cs_cd',
                'mt_suppliers.supplier_name as cs_name',
                'trn_order_headers.order_number as order_number',
                'mt_warehouses.warehouse_cd as warehouse_cd',
                'mt_warehouses.warehouse_name as warehouse_name',
            )->leftJoin('trn_order_details', 'trn_order_headers.id', 'trn_order_details.trn_order_header_id')
            ->leftJoin('mt_warehouses', 'trn_order_headers.mt_warehouse_id', 'mt_warehouses.id')
            ->leftJoin('trn_order_breakdowns', 'trn_order_details.id', 'trn_order_breakdowns.trn_order_detail_id')
            ->leftJoin('mt_stock_keeping_units', 'trn_order_breakdowns.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id')
            ->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->leftJoin('mt_stocks', 'mt_stock_keeping_units.id', 'mt_stocks.mt_stock_keeping_unit_id')
            ->leftJoin('mt_suppliers', 'trn_order_headers.mt_supplier_id', 'mt_suppliers.id')
            ->leftJoin('trn_order_receive_breakdowns', 'mt_stock_keeping_units.id', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('trn_order_receive_details', 'trn_order_receive_breakdowns.trn_order_receive_detail_id', 'trn_order_receive_details.id')
            ->when(isset($startDate), function ($query) use ($startDate, $endDate) {
                return $query->where(function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween("order_date", [$startDate, $endDate]);
                });
            })->when(isset($params['start_item_code']), function ($query) use ($startItemCode) {
                return $query->where(function ($query) use ($startItemCode) {
                    return $query->where("item_cd", '>=', $startItemCode);
                });
            })->when(isset($params['end_item_code']), function ($query) use ($endItemCode) {
                return $query->where(function ($query) use ($endItemCode) {
                    return $query->where("item_cd", '<=', $endItemCode);
                });
            })->when(isset($params['start_color_code']), function ($query) use ($startColorCode) {
                return $query->where(function ($query) use ($startColorCode) {
                    return $query->where("color_cd", '>=', $startColorCode);
                });
            })->when(isset($params['end_color_code']), function ($query) use ($endColorCode) {
                return $query->where(function ($query) use ($endColorCode) {
                    return $query->where("color_cd", '<=', $endColorCode);
                });
            })->when(isset($params['start_size_code']), function ($query) use ($startSizeCode) {
                return $query->where(function ($query) use ($startSizeCode) {
                    return $query->where("size_cd", '>=', $startSizeCode);
                });
            })->when(isset($params['end_size_code']), function ($query) use ($endSizeCode) {
                return $query->where(function ($query) use ($endSizeCode) {
                    return $query->where("size_cd", '<=', $endSizeCode);
                });
            })->when(isset($params['start_warehouse_code']), function ($query) use ($startWarehouseCode) {
                return $query->where(function ($query) use ($startWarehouseCode) {
                    return $query->where("warehouse_cd", '>=', $startWarehouseCode);
                });
            })->when(isset($params['end_warehouse_code']), function ($query) use ($endWarehouseCode) {
                return $query->where(function ($query) use ($endWarehouseCode) {
                    return $query->where("warehouse_cd", '<=', $endWarehouseCode);
                });
            })->orderBy('item_cd')->orderBy('color_cd')->orderBy('size_cd')
                ->get();
        }
        $allData = $target1Data->concat($target2Data);
        $result = $allData->sortBy(['item_cd', 'color_cd', 'size_cd']);
        return $result;
     }

     public function createTrnOrderReceiveHeader($params)
     {
        $trnOrderReceiveHeader = new TrnOrderReceiveHeader($params);
        $trnOrderReceiveHeader->save();
        return $trnOrderReceiveHeader;
     }

     public function searchOrderReceiveList($params)
     {
        // $paramsが空配列の場合
        if (empty($params)) {
            // 空コレクションを返す
            return collect();
        } else {
            $query = TrnOrderReceiveHeader::where('mt_user_input_id', 81);
            // order_receive_number_fromとorder_receive_number_toで絞る
            if (isset($params['order_receive_number_from']) && !is_null($params['order_receive_number_from'])) {
                $query->where('order_receive_number', '>=', $params['order_receive_number_from']);
            }
            if (isset($params['order_receive_number_to']) && !is_null($params['order_receive_number_to'])) {
                $query->where('order_receive_number', '>=', $params['order_receive_number_to']);
            }
            if (isset($params['ec_order_receive_number_all_flg']) && $params['ec_order_receive_number_all_flg'] != '1') {
                // ec_order_receive_number_from, ec_order_receive_number_toで絞る
                if (isset($params['ec_order_receive_number_from']) && !is_null($params['ec_order_receive_number_from'])) {
                    $query->where('ec_order_receive_number', '>=', $params['ec_order_receive_number_from']);
                }
                if (isset($params['ec_order_receive_number_to']) && !is_null($params['ec_order_receive_number_to'])) {
                    $query->where('ec_order_receive_number', '<=', $params['ec_order_receive_number_to']);
                }
            }
            if (isset($params['order_receive_date_all_flg']) && $params['order_receive_date_all_flg'] != '1') {
                if (isset($params['order_receive_date_year_from']) && !is_null($params['order_receive_date_year_from']) &&
                    isset($params['order_receive_date_month_from']) && !is_null($params['order_receive_date_month_from']) &&
                    isset($params['order_receive_date_day_from']) && !is_null($params['order_receive_date_day_from'])) {
                    $order_date = $params['order_receive_date_year_from'] . '-' . $params['order_receive_date_month_from'] . '-' . $params['order_receive_date_day_from'];
                    $query->where('order_receive_date', '>=', $order_date);
                }
                if (isset($params['order_receive_date_year_to']) && !is_null($params['order_receive_date_year_to']) &&
                    isset($params['order_receive_date_month_to']) && !is_null($params['order_receive_date_month_to']) &&
                    isset($params['order_receive_date_day_to']) && !is_null($params['order_receive_date_day_to'])) {
                    $order_date = $params['order_receive_date_year_to'] . '-' . $params['order_receive_date_month_to'] . '-' . $params['order_receive_date_day_to'];
                    $query->where('order_receive_date', '<=', $order_date);
                }
            }
            if (isset($params['release_start_datetime_year_from']) && !is_null($params['release_start_datetime_year_from']) &&
                isset($params['release_start_datetime_month_from']) && !is_null($params['release_start_datetime_month_from']) &&
                isset($params['release_start_datetime_day_from']) && !is_null($params['release_start_datetime_day_from'])) {
                $release_start_datetime_from = $params['release_start_datetime_year_from'] . '-' . $params['release_start_datetime_month_from'] . '-' . $params['release_start_datetime_day_from'];
                // 配下の全てのTrnOrderReceiveDetailのspecify_deadlineが$release_start_datetime_fromより大きいものを取得
                $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($release_start_datetime_from) {
                    $query->where('specify_deadline', '<', $release_start_datetime_from);
                });
            }
            if (isset($params['release_start_datetime_year_to']) && !is_null($params['release_start_datetime_year_to']) &&
                isset($params['release_start_datetime_month_to']) && !is_null($params['release_start_datetime_month_to']) &&
                isset($params['release_start_datetime_day_to']) && !is_null($params['release_start_datetime_day_to'])) {
                $release_start_datetime_to = $params['release_start_datetime_year_to'] . '-' . $params['release_start_datetime_month_to'] . '-' . $params['release_start_datetime_day_to'];
                // 配下の全てのTrnOrderReceiveDetailのspecify_deadlineが$release_start_datetime_toより小さいものを取得
                $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($release_start_datetime_to) {
                    $query->where('specify_deadline', '>', $release_start_datetime_to);
                });
            }
            if (isset($params['mt_manager_cd_from']) && !is_null($params['mt_manager_cd_from'])) {
                $mt_manager_from = MtManager::where('manager_cd', $params['mt_manager_cd_from'])->first();
                if (!is_null($mt_manager_from)) {
                    $query->where('mt_manager_id', '>=', $mt_manager_from->id);
                }
            }
            if (isset($params['mt_manager_id_to']) && !is_null($params['mt_manager_id_to'])) {
                $mt_manager_to = MtManager::where('manager_cd', $params['mt_manager_cd_to'])->first();
                if (!is_null($mt_manager_to)) {
                    $query->where('mt_manager_id', '<=', $mt_manager_to->id);
                }
            }
            if (isset($params['shipping_kbn']) && !is_null($params['shipping_kbn'])) {
                $query->where('shipping_kbn', $params['shipping_kbn']);
            }
            if (isset($params['mt_user_input_cd_from']) && !is_null($params['mt_user_input_cd_from'])) {
                $mt_user_input_from = MtUser::where('user_cd', $params['mt_user_input_cd_from'])->first();
                if (!is_null($mt_user_input_from)) {
                    $query->where('mt_user_input_id', '>=', $mt_user_input_from->id);
                }
            }
            if (isset($params['mt_user_input_cd_to']) && !is_null($params['mt_user_input_cd_to'])) {
                $mt_user_input_to = MtUser::where('user_cd', $params['mt_user_input_cd_to'])->first();
                if (!is_null($mt_user_input_to)) {
                    $query->where('mt_user_input_id', '<=', $mt_user_input_to->id);
                }
            }
            if (isset($params['customer_from']) && !is_null($params['customer_from'])) {
                $customer_from = MtCustomer::where('customer_cd', $params['customer_from'])->first();
                if (!is_null($customer_from)) {
                    $query->where('mt_customer_id', '>=', $customer_from->id);
                }
            }
            if (isset($params['customer_to']) && !is_null($params['customer_to'])) {
                $customer_to = MtCustomer::where('customer_cd', $params['customer_to'])->first();
                if (!is_null($customer_to)) {
                    $query->where('mt_customer_id', '<=', $customer_to->id);
                }
            }
            if (isset($params['delivery_destination_from']) && !is_null($params['delivery_destination_from'])) {
                $delivery_destination_from = MtDeliveryDestination::where('delivery_destination_id', $params['delivery_destination_from'])->first();
                if (!is_null($delivery_destination_from)) {
                    $query->where('mt_delivery_destination_id', '>=', $delivery_destination_from->id);
                }
            }
            if (isset($params['delivery_destination_to']) && !is_null($params['delivery_destination_to'])) {
                $delivery_destination_to = MtDeliveryDestination::where('delivery_destination_id', $params['delivery_destination_to'])->first();
                if (!is_null($delivery_destination_to)) {
                    $query->where('mt_delivery_destination_id', '<=', $delivery_destination_to->id);
                }
            }
            if (isset($params['root_cd']) && !is_null($params['root_cd'])) {
                $mt_root = MtRoot::where('root_cd', $params['root_cd'])->first();
                if (!is_null($mt_root)) {
                    $query->where('mt_root_id', $mt_root->id);
                }
            }
            if (isset($params['ec_order_receive_check']) && !is_null($params['ec_order_receive_check'])) {
                $query->where('ec_order_receive_check', $params['ec_order_receive_check']);
            }
            if (isset($params['payment_kbn']) && !is_null($params['payment_kbn'])) {
                $query->where('payment_kbn', $params['payment_kbn']);
            }
            if (isset($params['shortage']) && !is_null($params['shortage'])) {
                if ($params['shortage'] != '2') {
                    $query->where('shortage_guidance_flg', $params['shortage']);
                }
            }
            if (isset($params['order_receive_remaining']) && !is_null($params['order_receive_remaining'])) {
                if ($params['order_receive_remaining'] != '2') {
                    $order_receive_remaining = $params['order_receive_remaining'];
                    $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($order_receive_remaining) {
                        $query->where('remaining_flg', '!=', $order_receive_remaining);
                    });
                }
            }
            if (isset($params['payment_finish']) && !is_null($params['payment_finish'])) {
                if ($params['payment_finish'] != '2') {
                    $payment_finish = $params['payment_finish'];
                    $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($payment_finish) {
                        $query->where('payment_finish_flg', '!=', $payment_finish);
                    });
                }
            }
            if (isset($params['japan_post_office_alignment']) && !is_null($params['japan_post_office_alignment'])) {
                if ($params['japan_post_office_alignment'] != '2') {
                    $japan_post_office_alignment = $params['japan_post_office_alignment'];
                    $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($japan_post_office_alignment) {
                        $query->where('japan_post_office_alignment_flg', '!=', $japan_post_office_alignment);
                    });
                }
            }
            if (isset($params['credit_settlement']) && !is_null($params['credit_settlement'])) {
                if ($params['credit_settlement'] != '3') {
                    if ($params['credit_settlement'] == '0') {
                        $query->where('settlement_method', 1);
                    }
                    if ($params['credit_settlement'] == '2') {
                        $query->where('settlement_method', 0);
                    }
                }
            }
            if (isset($params['detail_sticky_note']) && !is_null($params['detail_sticky_note'])) {
                $detail_sticky_notes = $params['detail_sticky_note'];
                // $detail_sticky_notesに0が含まれている場合
                if (!in_array('0', $detail_sticky_notes)) {
                    $query->whereHas('mtOrderReceiveStickyNotes', function ($query) use ($detail_sticky_notes) {
                        $query->whereIn('id', $detail_sticky_notes);
                    });
                }
            }
            if (isset($params['payment_guidance_slip']) && !is_null($params['payment_guidance_slip'])) {
                if ($params['payment_guidance_slip'] != '3') {
                    $query->where('payment_guidance_kbn', $params['payment_guidance_slip']);
                }
            }
            if (isset($params['payment_guidance_issue']) && !is_null($params['payment_guidance_issue'])) {
                if ($params['payment_guidance_issue'] != '2') {
                    $query->where('payment_guidance_flg', $params['payment_guidance_issue']);
                }
            }
            if (isset($params['keep_guidance_slip']) && !is_null($params['keep_guidance_slip'])) {
                if ($params['keep_guidance_slip'] != '3') {
                    if ($params['keep_guidance_slip'] == '0') {
                        $query->where('keep_guidance_target_flg', 0);
                    }
                    if ($params['keep_guidance_slip'] == '1') {
                        $query->where('keep_guidance_target_flg', 1);
                    }
                    if ($params['keep_guidance_slip'] == '2') {
                        $query->where('keep_guidance_expiration_flg', 1);
                    }
                }
            }
            if (isset($params['keep_guidance_issue']) && !is_null($params['keep_guidance_issue'])) {
                if ($params['keep_guidance_issue'] != '2') {
                    $query->where('keep_guidance_flg', $params['keep_guidance_issue']);
                }
            }
            if (isset($params['shortage_guidance_issue']) && !is_null($params['shortage_guidance_issue'])) {
                if ($params['shortage_guidance_issue'] != '2') {
                    $query->where('shortage_guidance_flg', $params['shortage_guidance_issue']);
                }
            }
            if (isset($params['shipping_guidance_order_receive_issue']) && !is_null($params['shipping_guidance_order_receive_issue'])) {
                if ($params['shipping_guidance_order_receive_issue'] != '2') {
                    $query->where('shipping_guidance_flg', $params['shipping_guidance_order_receive_issue']);
                }
            }
            if (isset($params['shipping_preparation']) && !is_null($params['shipping_preparation'])) {
                if ($params['shipping_preparation'] != '4') {
                    $shipping_preparation = $params['shipping_preparation'];
                    if ($shipping_preparation == '0' || $shipping_preparation == '1' || $shipping_preparation == '2') {
                        $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($shipping_preparation) {
                            $query->where('shipping_preparation_flg', '!=', 0);
                        });
                    } else if ($shipping_preparation == '3') {
                        $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($shipping_preparation) {
                            $query->where('shipping_preparation_flg', '!=', 1);
                        });
                    }
                }
            }
            if (isset($params['picking_list_issue']) && !is_null($params['picking_list_issue'])) {
                if ($params['picking_list_issue'] != '4') {
                    $picking_list_issue = $params['picking_list_issue'];
                    if ($picking_list_issue == '0' || $picking_list_issue == '1' || $picking_list_issue == '2') {
                        $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($picking_list_issue) {
                            $query->where('picking_list_output_flg', '!=', 0);
                        });
                    } else if ($picking_list_issue == '3') {
                        $query->whereHasNot('trnOrderReceiveDetails', function ($query) use ($picking_list_issue) {
                            $query->where('picking_list_output_flg', '!=', 1);
                        });
                    }
                }
            }
            if (isset($params['inspection']) && !is_null($params['inspection'])) {
                if ($params['inspection'] != '5') {
                    $inspection = $params['inspection'];
                    if ($inspection == '0') {
                        $query->whereHasNot('trnShippingInspectionHeaders', function ($query) use ($inspection) {
                            $query->where('inspection_flg', '!=', 0);
                        });
                    } else if ($inspection == '1' || $inspection == '2') {
                        $query->whereHasNot('trnShippingInspectionHeaders', function ($query) use ($inspection) {
                            $query->where('inspection_flg', '!=', 2);
                        });
                    } else if ($inspection == '3') {
                        $query->whereHasNot('trnShippingInspectionHeaders', function ($query) use ($inspection) {
                            $query->where('inspection_flg', '!=', 1);
                        });
                    } else if ($inspection == '4') {
                        $query->whereHasNot('trnShippingInspectionHeaders', function ($query) use ($inspection) {
                            $query->where('pendding_flg', '!=', 1);
                        });
                    }
                }
            }
            if (isset($params['sale_slip_issue']) && !is_null($params['sale_slip_issue'])) {
                $sale_slip_issue = $params['sale_slip_issue'];
                if ($sale_slip_issue != '4') {
                    if ($sale_slip_issue == '0') {
                        // trnSaleDetailsを１つも持っていないtrnOrderReceiveDetailを持っているものを取得
                        $query->whereHasNot('trnOrderReceiveDetails', function ($query) {
                            $query->whereDoesntHave('trnSaleDetails');
                        });
                    } else if ($sale_slip_issue == '3') {
                        // 配下のtrnOrderReceiveDetailがtrnSaleDetailsを１つ以上持っているものを取得
                        $query->whereHas('trnOrderReceiveDetails', function ($query) {
                            $query->whereHas('trnSaleDetails');
                        });
                    } else if ($sale_slip_issue == '1' || $sale_slip_issue == '2') {
                        // 上記（0, 3）以外のものを取得
                        $query->whereHasNot('trnOrderReceiveDetails', function ($query) {
                            $query->whereHas('trnSaleDetails');
                        });
                    }
                }
            }

            // 最新の100件だけを取得して返す
            return $query->orderBy('id', 'desc')->with('mtCustomer', 'mtDeliveryDestination', 'mtOrderReceiveStickyNote', 'trnShippingInspectionHeaders')->take(100)->get();
        }
     }

     public function updateAccountantList($params)
     {
         if (isset($params['orders']) && !empty($params['orders'])) {
             foreach ($params['orders'] as $order) {
                 $trnOrderReceiveHeader = TrnOrderReceiveHeader::find($order['order_id']);
                 if ($params['kbn'] == '0') {
                     if (isset($order['ec_check_flg'])) {
                         $trnOrderReceiveHeader->ec_order_receive_check_flg = $order['ec_check_flg'];
                     } else {
                         $trnOrderReceiveHeader->ec_order_receive_check_flg = 0;
                     }
                 }
                 if ($params['kbn'] == '1') {
                     // 全てのtrnOrderReceiveDetailのshipping_preparation_flgを更新する
                    $trnOrderReceiveHeader->trnOrderReceiveDetails()->update(['shipping_preparation_flg' => isset($order['shipping_check_flg']) ? $order['shipping_check_flg'] : 0]);
                 }
                 if ($params['kbn'] == '2') {
                     $trnOrderReceiveHeader->delivery_destination_check_flg = isset($order['destination_check_flg']) ? $order['destination_check_flg'] : 0;
                 }
                 $trnOrderReceiveHeader->save();
             }
         }
     }
}
