<?php

namespace App\Repositories\Analyse\AnaCustomerData;

use App\Consts\CommonConsts;
use App\Models\MtCustomer;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaCustomerDataRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
	const DEF_SELECT = [
		'customer_cd',
		'customer_name',
		'customer_name_kana',
		'post_number',
		'address',
		'tel',
		'fax',
		'customer_memo_1',
		'customer_memo_2',
		'mt_billing_address_id',
		'mt_root_id',
		'mt_item_class_shipping_companie_id',
		'mt_billing_addresses.billing_address_cd',
		'mt_roots.root_name',
		'mt_item_classes.item_class_name',
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
		$query = parent::orderByButton($params, $query);
		return $query;
	}

	private function query($params)
	{
		$query = MtCustomer::select(...self::DEF_SELECT)
			->leftJoin('mt_billing_addresses', 'mt_billing_addresses.id', '=', 'mt_billing_address_id')
			->leftJoin('mt_roots', 'mt_roots.id', '=', 'mt_root_id')
			->leftJoin('mt_item_classes', 'mt_item_classes.id', '=', 'mt_item_class_shipping_companie_id');
		return $query;
	}
}
