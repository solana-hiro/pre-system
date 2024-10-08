<?php

namespace App\Repositories\TrnOrderDetail;
use App\Models\TrnOrderDetail;
use Carbon\Carbon;
use App\Consts\CommonConsts;

class TrnOrderDetailRepository implements TrnOrderDetailRepositoryInterface
{

    
    public function getAll()
    {
        $result = TrnOrderDetail::with(['trnOrderHeader', 'mtItem'])->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    public function get($params)
    {
        $orderNumber = $params['order_number'] ?? null;
        $contractNumber = $params['contract_number'] ?? null;
        $orderStartDate = $params['order_start_date'] ?? null;
        $orderEndDate = $params['order_end_date'] ?? null;
    
        $query = TrnOrderDetail::with(['trnOrderHeader', 'mtItem']);
    
        // Apply filters only if the parameters are not null
        if ($orderNumber) {
            $query->whereHas('trnOrderHeader', function ($q) use ($orderNumber) {
                $q->where('order_number', 'LIKE', "%{$orderNumber}%");
            });
        }



        if ($contractNumber) {
            $query->whereHas('trnOrderHeader', function ($q) use ($contractNumber) {
                $q->where('partner_number', 'LIKE', "%{$contractNumber}%");
            });
        }
        if ($orderStartDate) {
            $query->whereHas('trnOrderHeader', function ($q) use ($orderStartDate) {
                $q->where('specify_deadline', '>=', Carbon::parse($orderStartDate));
            });
        }
        if ($orderEndDate) {
            $query->whereHas('trnOrderHeader', function ($q) use ($orderEndDate) {
                $q->where('specify_deadline', '<=', Carbon::parse($orderEndDate));
            });
        }

        $result = $query->paginate(CommonConsts::PAGINATION);

        return $result;
    }

}
