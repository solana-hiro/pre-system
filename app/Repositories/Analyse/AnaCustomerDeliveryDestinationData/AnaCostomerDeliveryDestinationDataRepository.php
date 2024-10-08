<?php

namespace App\Repositories\Analyse\AnaCustomerDeliveryDestinationData;

use App\Consts\CommonConsts;
use App\Models\MtCustomerDeliveryDestination;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaCostomerDeliveryDestinationDataRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
	const DEF_SELECT = [
		'mt_delivery_destinations.delivery_destination_id',
		'mt_delivery_destinations.delivery_destination_name',
		'mt_delivery_destinations.delivery_destination_name_kana',
		'mt_delivery_destinations.post_number',
		'mt_delivery_destinations.address',
		'mt_delivery_destinations.tel',
		'mt_delivery_destinations.fax',
		'mt_customers.customer_cd',
		'mt_roots.root_name',
		'def_arrival_dates.arrival_date_name',
		'mt_customer_delivery_destinations.sale_decision_print_paper_flg',
		'mt_item_classes.item_class_name',
		'mt_delivery_destinations.del_kbn_delivery_destination',
		'mt_customer_delivery_destinations.del_kbn_customer',
	];

	public function search($params)
	{
		$data = $this
			->common($params)
			->paginate(CommonConsts::ANALSE_PAGINATION)
			->withQueryString();
		return $data;
	}

	public function csv($params)
	{
		$query = $this->common($params);
		return $query;
	}

	private function common($params)
	{
		$query = $this->query($params);
		$query = $this->filter($params, $query);
		$query = parent::orderByButton($params, $query);
		$query = $this->order($query);
		return $query;
	}

	private function query($params)
	{
		$query = MtCustomerDeliveryDestination::select(...self::DEF_SELECT)
			->leftJoin('mt_delivery_destinations', 'mt_delivery_destinations.id', '=', 'mt_customer_delivery_destinations.mt_delivery_destination_id')
			->leftJoin('mt_customers', 'mt_customers.id', '=', 'mt_customer_delivery_destinations.mt_customer_id')
			->leftJoin('mt_roots', 'mt_roots.id', '=', 'mt_customer_delivery_destinations.mt_root_id')
			->leftJoin('def_arrival_dates', 'def_arrival_dates.id', '=', 'mt_customer_delivery_destinations.def_arrival_date_id')
			->leftJoin('mt_item_classes', 'mt_item_classes.id', '=', 'mt_customer_delivery_destinations.mt_item_class_shipping_companie_id');
		return $query;
	}

	private function filter($params, $query)
	{
		$query = parent::filterByValue($params, $query, 'mt_customer_delivery_destinations', 'del_kbn_customer');
		return $query;
	}

	private function order($query)
	{
		$query = $query
			->orderBy('mt_delivery_destinations.delivery_destination_id', 'asc')
			->orderBy('mt_customers.customer_cd', 'asc');
		return $query;
	}
}
