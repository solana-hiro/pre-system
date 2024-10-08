<?php
namespace App\Repositories\MtSystem;

use App\Models\MtSystem;
use App\Models\MtWarehouse;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtSystemRepository implements MtSystemRepositoryInterface
{

    /**
     * システム取得 全件取得
     * @return Object
     */
    public function getAll() {
		$result = MtSystem::paginate(CommonConsts::PAGINATION);
		return $result;
    }

    /**
     * システム取得 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtSystem::select('mt_system.*', 'mt_warehouses.warehouse_cd')
            ->leftJoin('mt_warehouses', 'mt_system.mt_warehouse_id', 'mt_warehouses.id')
            ->where('mt_system.id', 1)->first();
        return $result;
    }

    /**
     * システム取得 更新
     * @param $param
     * @return Object
     */
    public function update($params) {
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $mtSystem = MtSystem::where('id', $params['update_id'])->first();
            $mtSystem->corp_name = $params['corp_name'];
            $mtSystem->corp_name_abbreviation = $params['corp_name_abbreviation'];
            $mtSystem->corp_name_kana = $params['corp_name_kana'];
            $mtSystem->post_number = $params['post_number'];
            $mtSystem->address_1 = $params['address_1'];
            $mtSystem->tel = $params['tel'];
            $mtSystem->fax = $params['fax'];
            $mtSystem->representative_name = $params['representative_name'];
            $mtSystem->manager_name = $params['manager_name'];
            $mtSystem->memo_1 = $params['memo_1'];
            $mtSystem->memo_2 = $params['memo_2'];
            $mtSystem->memo_3 = $params['memo_3'];
            $mtSystem->settlement_month_date = $params['settlement_month_date'];
            $mtSystem->stock_evaluation_method = $params['stock_evaluation_method'];
            $mtSystem->accounts_receivable_payable_tax_kbn = $params['accounts_receivable_payable_tax_kbn'];   //Carbon::createFromFormat('Y-m-d'
            $mtSystem->sale_price_adoption_kbn = $params['sale_price_adoption_kbn'];
            $mtSystem->detail_keep_period_month = $params['detail_keep_period_month'];
            $mtSystem->summary_keep_period_year = $params['summary_keep_period_year'];
            if(!empty($params['operation_start_date_year']) && !empty($params['operation_start_date_month']) && !empty($params['operation_start_date_day']) ) {
                $mtSystem->operation_start_date = Carbon::createFromFormat('Y-m-d', $params['operation_start_date_year'].'-'.$params['operation_start_date_month'].'-'.$params['operation_start_date_day']);
            }
            if (!empty($params['year_update_execution_date_year']) && !empty($params['year_update_execution_date_month']) && !empty($params['year_update_execution_date_day'])) {
                $mtSystem->year_update_execution_date = Carbon::createFromFormat('Y-m-d', $params['year_update_execution_date_year'].'-'.$params['year_update_execution_date_month'].'-'.$params['year_update_execution_date_day']);
            }
            if (!empty($params['month_update_execution_date_year']) && !empty($params['month_update_execution_date_month']) && !empty($params['month_update_execution_date_day'])) {
                $mtSystem->month_update_execution_date = Carbon::createFromFormat('Y-m-d', $params['month_update_execution_date_year'].'-'.$params['month_update_execution_date_month'].'-' .$params['month_update_execution_date_day']);
            }
            $mtSystem->industry_cd = $params['industry_cd'];
            $mtSystem->version = $params['version'];
            $mtSystem->shipping_apportionment_method = $params['shipping_apportionment_method'];
            $mtSystem->marketing_possible_quantity_initial_display = $params['marketing_possible_quantity_initial_display'];
            $mtSystem->shipping_quantity_initial_display = $params['shipping_quantity_initial_display'];
            $mtWarehouseId = MtWarehouse::where('warehouse_cd', $params['warehouse_cd'])->first();
            $mtSystem->mt_warehouse_id = $mtWarehouseId['id'];
            $mtSystem->apportionment_possible_quantity_input_kbn = $params['apportionment_possible_quantity_input_kbn'];
            $mtSystem->instruction_possible_quantity_input_kbn = $params['instruction_possible_quantity_input_kbn'];
            $mtSystem->handy_adoption_kbn = $params['handy_adoption_kbn'];
            $mtSystem->barcode_issue_order = $params['barcode_issue_order'];
            $mtSystem->start_jan_code = $params['start_jan_code'];
            $mtSystem->barcode_issue_purchase = $params['barcode_issue_purchase'];
            $mtSystem->barcode_issue_in_out = $params['barcode_issue_in_out'];
            $mtSystem->end_jan_code = $params['end_jan_code'];
            $mtSystem->now_jan_code = $params['now_jan_code'];
            $mtSystem->ecsite_open_situation = $params['ecsite_open_situation'];
            $mtSystem->maintenance_text = $params['maintenance_text'];
            $mtSystem->settlement_method_name = $params['settlement_method_name'];
            $mtSystem->display_flg = $params['display_flg'];
            $mtSystem->explanatory_text = $params['explanatory_text'];
            $mtSystem->shop_id = $params['shop_id'];
            $mtSystem->shop_password = $params['shop_password'];
            $mtSystem->{'3dsecure_display_store_name'} = $params['3dsecure_display_store_name'];
            $mtSystem->token_conversion_api_key = $params['token_conversion_api_key'];
            $mtSystem->token_conversion_api_key = $params['token_conversion_api_key'];
            $mtSystem->site_id = $params['site_id'];
            $mtSystem->site_password = $params['site_password'];
            $mtSystem->access_point = $params['access_point'];
            $mtSystem->{'1_year_less_than_stock_rate'} = $params['1_year_less_than_stock_rate'];
            $mtSystem->{'1_year_before_stock_rate'} = $params['1_year_before_stock_rate'];
            $mtSystem->{'2_year_before_stock_rate'} = $params['2_year_before_stock_rate'];
            $mtSystem->{'3_year_before_stock_rate'} = $params['3_year_before_stock_rate'];
            $mtSystem->{'4_year_before_stock_rate'} = $params['4_year_before_stock_rate'];
            $mtSystem->mt_user_last_update_id = Auth::user()->id;
            $mtSystem->save();
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }
}
