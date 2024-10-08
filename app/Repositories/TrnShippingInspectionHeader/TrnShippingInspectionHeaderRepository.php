<?php
namespace App\Repositories\TrnShippingInspectionHeader;

use App\Models\TrnShippingInspectionHeader;
use App\Models\TrnOrderReceiveDetail;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Consts\CommonConsts;

class TrnShippingInspectionHeaderRepository implements TrnShippingInspectionHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnShippingInspectionHeader::get();
		return $result;
    }

    /**
     * 出荷案内発行の情報取得
     * @param array $params
     * @return Object
     */
     public function getGuidanceIssue(array $params) {
        /*
        ●データ抽出条件
▼対象が「0:売上のみ」の場合
（売上ヘッダ.売上日　＞= 絞込み条件の「売上日」最小値）　　AND
（売上ヘッダ.売上日　＜= 絞込み条件の「売上日」最大値）　　AND
（売上ヘッダ.受注ヘッダID.得意先マスタID　＞= 絞込み条件の「得意先」最小値）　　AND
（売上ヘッダ.受注ヘッダID.得意先マスタID　＜= 絞込み条件の「得意先」最大値）　　AND
（売上ヘッダ.納品先マスタID　＞= 絞込み条件の「納品先」最小値）　　AND
（売上ヘッダ.納品先マスタID　＜= 絞込み条件の「納品先」最大値）　　AND
（売上明細.受注明細ID.ピッキングリスト出力フラグ==出力済　OR 売上明細.受注明細ID.トータルピッキングリスト出力フラグ==出力済）

▼対象が「1:すべて」の場合
（受注明細.指定納期　＞= 絞込み条件の「指定納期」最小値）　　AND
（受注明細.指定納期　＜= 絞込み条件の「指定納期」最大値）　　AND
（受注ヘッダ.得意先マスタID　＞= 絞込み条件の「得意先」最小値）　　AND
（受注ヘッダ.得意先マスタID　＜= 絞込み条件の「得意先」最大値）　　AND
（受注ヘッダ.納品先マスタID　＞= 絞込み条件の「納品先」最小値）　　AND
（受注ヘッダ.納品先マスタID　＜= 絞込み条件の「納品先」最大値）　　AND
（受注明細.ピッキングリスト出力フラグ==出力済　OR 受注明細.トータルピッキングリスト出力フラグ==出力済）
*/

     	$result = TrnShippingInspectionHeader::get();
        return $result;
     }

    /**
     * 出荷検品処理の情報取得
     * @param array $params
     * @return Object
     */
     public function getInspection(array $params) {
     	$result = TrnShippingInspectionHeader::get();
        return $result;
     }

    /**
     * 出荷検品情報の更新
     * @param array $params
     * @return Object
     */
     public function updateInspection(array $params) {
     	$result = TrnShippingInspectionHeader::get();
     	// DB更新
        return $result;
     }

    /**
     * 出荷検品情報の手検品実行
     * @param array $params
     * @return Object
     */
     public function executeInspection(array $params) {
     	$result = TrnShippingInspectionHeader::get();
     	// TODO: DB更新
        return $result;
     }

    /**
     * ピッキングリスト発行の情報取得
     * @param array $params
     * @return Object
     */
     public function getPickingList(array $params) {
        $date = $params['date_year'] . "-" . $params['date_month'] . "-" . $params['date_day'];
        $orderReceiveNumberStart = $params['order_receive_number_start'];
        $orderReceiveNumberEnd = $params['order_receive_number_end'];
        $customerStart = $params['customer_start'];
        $customerEnd = $params['customer_end'];
        $deliveryDestinationStart = $params['delivery_destination_start'];
        $deliveryDestinationEnd = $params['delivery_destination_end'];
        $rootStart = $params['root_start'];
        $rootEnd = $params['root_end'];
     	$result = TrnShippingInspectionHeader::get();
     	//DB更新
        return $result;
     }

    /**
     * トータルピッキングリスト発行の情報取得
     * @param array $params
     * @return Object
     */
     public function getTotalPickingList(array $params) {
        // 受注明細  追加条件: 受注明細の「出荷準備フラグ:shipping_preparation_flg」が「1:準備済」, 受注明細の「受注完了フラグ:order_receive_finish_flg」が「0：未完」
        $date = $params['date_year'] . "-" . $params['date_month'] . "-" . $params['date_day'];
        $orderReceiveNumberStart = $params['order_receive_number_start'];
        $orderReceiveNumberEnd = $params['order_receive_number_end'];
        $customerStart = $params['customer_start'];
        $customerEnd = $params['customer_end'];
        $deliveryDestinationStart = $params['delivery_destination_start'];
        $deliveryDestinationEnd = $params['delivery_destination_end'];
        $rootStart = $params['root_start'];
        $rootEnd = $params['root_end'];
        $brand1 = $params['brand1'] ? $params['brand1'] : '807777'; //807777:郵政通常便
        $totalPickingListOutputFlg = $params['total_picking_list_output_flg'];

        // ヤマト便の場合
        if($brand1 === '812222') {
            return null;
        }

        // TODO: 関連の商品　SKU単位で出力 color,
     	$result = TrnOrderReceiveDetail::select(
            'trn_order_receive_details.*',
            //'trn_order_receive_header.*',
        )->leftJoin('trn_order_receive_header', 'trn_order_receive_details.trn_order_receive_header_id', 'trn_order_receive_header.id')
            ->leftJoin('mt_customers', 'trn_order_receive_header.mt_customer_id', 'trn_order_receive_header')
            ->leftJoin('mt_customer_classes', 'trn_order_receive_header.mt_customer_class_id', 'mt_customer_classes.id')
            ->leftJoin('mt_delivery_destinations', 'trn_order_receive_header.mt_delivery_destination_id', 'mt_delivery_destinations.id')
            ->leftJoin('mt_warehouses', 'trn_order_receive_header.mt_warehouse_id', 'mt_warehouses.id')
            ->leftJoin('mt_roots', 'trn_order_receive_header.mt_root_id', 'mt_roots.id')
            ->leftJoin('mt_item_classes', 'trn_order_receive_header.mt_item_class_shipping_companie_id', 'mt_item_classes.id')
            ->leftJoin('mt_items', 'trn_order_receive_details.mt_item_id', 'mt_items.id')
            ->where('trn_order_receive_details.specify_deadline', $date)
            ->whereBetween('trn_order_receive_headers.order_receive_number', [$orderReceiveNumberStart, $orderReceiveNumberEnd])
            ->whereBetween('trn_order_receive_details.specify_deadline', $date)
            ->whereBetween('mt_customers.customer_cd', [$customerStart, $customerEnd])
            ->whereBetween('mt_delivery_destinations.delivery_destination_id', [$deliveryDestinationStart, $deliveryDestinationEnd])
            ->whereBetween('mt_roots.root_cd', [$rootStart, $rootEnd])
            ->where('trn_order_receive_details.root_cd', $brand1)
            ->where('mt_item_classes.shipping_preparation_flg', 1)
            ->where('mt_item_classes.order_receive_finish_flg', 0)
            ->when($totalPickingListOutputFlg === '0' || $totalPickingListOutputFlg === '1', function ($query) use ($totalPickingListOutputFlg) {
                return $query->where(function ($query) use ($totalPickingListOutputFlg) {
                    return $query->where("total_picking_list_output_flg", $totalPickingListOutputFlg);
                });
            })->orderBy('mt_items.item.cd')
            ;
        // DB更新
        //受注明細のステータス更新
        return $result;
     }

}
