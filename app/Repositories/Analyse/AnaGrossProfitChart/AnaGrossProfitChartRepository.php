<?php

namespace App\Repositories\Analyse\AnaGrossProfitChart;

use App\Models\TrnSaleDetail;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnaGrossProfitChartRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
	const DEF_SELECT = [
		'mt_billing_addresses.billing_address_cd',
		'trn_sale_headers.bk_customer_name',
	];

	const DEF_MAIN_SELECT = [
		'billing_address_cd',
		'bk_customer_name',
		'net_sales',
		'loss_cost',
	];

	public function search($params)
	{
		$data = $this
			->common($params)
			->get();
		return $data;
	}

	public function csv($params)
	{
		$data = $this
			->common($params)
			->get();
		return $data;
	}

	private function common($params)
	{
		$subQuery = $this->subQuery($params);
		$subQuery = $this->group($subQuery);
		$subQuery = $this->filter($params, $subQuery);
		// $subQuery = parent::orderByButton($params, $subQuery);
		// $subQuery = $this->order($subQuery);
		$query = $this->query($params, $subQuery);
		return $query;
	}

	private function subQuery($params)
	{
		$select = [...self::DEF_SELECT, ...$this->sumSql()];
		$query = TrnSaleDetail::select(...$select)
			->leftJoin('trn_sale_headers', 'trn_sale_headers.id', '=', 'trn_sale_details.trn_sale_header_id')
			->leftJoin('trn_demand_headers', 'trn_demand_headers.id', '=', 'trn_sale_headers.trn_demand_header_id')
			->leftJoin('mt_billing_addresses', 'mt_billing_addresses.id', '=', 'trn_demand_headers.mt_billing_address_id')
			->leftJoin('mt_items', 'mt_items.id', '=', 'trn_sale_details.mt_item_id');
		return $query;
	}

	private function sumSql()
	{
		return [
			DB::raw('sum(coalesce(trn_sale_details.sale_amount) - coalesce(trn_sale_details.sale_tax)) as net_sales'),
			DB::raw('floor(sum(coalesce(trn_sale_details.cost_amount)) * 1.01) as loss_cost'),
		];
	}

	private function group($query)
	{
		return $query = $query->groupBy('mt_billing_addresses.billing_address_cd', 'trn_sale_headers.bk_customer_name');
	}

	private function filter($params, $query)
	{
		$query = parent::filterByValue($params, $query, 'mt_items', 'item_cd');
		$query = parent::filterByDate($params, $query, 'trn_sale_headers', 'sale_date');
		return $query;
	}

	public function order($query)
	{
		return $query;
	}

	private function query($params, $subQuery)
	{
		$select = [...self::DEF_MAIN_SELECT, $this->rankSql($params)];
		return DB::table($subQuery, 'sub')->select($select);
	}

	private function rankSql($params)
	{
		// SQLインジェクション対策にパラメータの中身はそのまま利用しない
		$column = $params['rank_base'] === 'net_sales' ? 'net_sales' : 'loss_cost';
		$order = $params['rank_order'] === 'asc' ? 'asc' : 'desc';
		return DB::raw("RANK() OVER (ORDER BY {$column} {$order}) as rank_no");
	}
}
