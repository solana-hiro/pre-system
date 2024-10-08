<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnOrderReceiveHeader extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
      'order_receive_number',
      'order_receive_date',
      'mt_user_input_id',
      'ec_order_receive_number',
      'mt_order_receive_sticky_note_id',
      'mt_customer_id',
      'mt_user_manager_id',
      'mt_delivery_destination_id',
      'order_number',
      'mt_warehouse_id',
      'payment_kbn',
      'payment_guidance_kbn',
      'payment_guidance_flg',
      'shortage_guidance_flg',
      'shipping_guidance_flg',
      'keep_guidance_target_flg',
      'keep_guidance_expiration_flg',
      'keep_guidance_flg',
      'process_kbn',
      'slip_memo',
      'customer_order_number',
      'separate_mail',
      'shipping_document_description_need_column',
      'business_memo',
      'mt_user_last_update_id',
      'customer_name',
      'customer_name_input_kbn',
      'delivery_destination_name_input_kbn'
    ];

    /**
     * 受注ヘッダ
     * @var string
     */
    protected $table = 'trn_order_receive_headers';

    /**
     * @return BelongsTo
     */
    public function mtUserInputId()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_input_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtCustomer()
    {
        return $this->belongsTo(MtCustomer::class, 'mt_customer_id')->with('mtBillingAddress');
    }

    /**
     * @return BelongsTo
     */
    public function mtCustomerClass()
    {
        return $this->belongsTo(MtCustomerClass::class, 'id', 'mt_customer_class_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserManager()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtDeliveryDestination()
    {
        return $this->belongsTo(MtDeliveryDestination::class, 'mt_delivery_destination_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtWarehouse()
    {
        return $this->belongsTo(MtWarehouse::class, 'id', 'mt_warehouse_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtOrderReceiveStickyNote()
    {
        return $this->belongsTo(MtOrderReceiveStickyNote::class, 'mt_order_receive_sticky_note_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtManager()
    {
        return $this->belongsTo(MtManager::class, 'id', 'mt_manager_id');
    }


    /**
     * @return BelongsTo
     */
    public function mtRoot()
    {
        return $this->belongsTo(MtRoot::class, 'id', 'mt_root_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtItemClass()
    {
        return $this->belongsTo(MtItemClass::class, 'id', 'mt_item_class_shipping_companie_id');
    }

    public function trnShippingInspectionHeaders()
    {
        return $this->hasMany(TrnShippingInspectionHeader::class, 'id', 'trn_order_receive_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function defArrivalDate()
    {
        return $this->belongsTo(DefArrivalDate::class, 'id', 'def_arrival_date_id');
    }

    /**
     * @return BelongsTo
     */
    public function mtUserLastUpdate()
    {
        return $this->belongsTo(MtUser::class, 'id', 'mt_user_last_update_id');
    }

    // attribute
    public function getShippingPreparationFlgAttribute($value)
    {
        $trnOrderReceiveDetails = $this->trnOrderReceiveDetails;
        // 出荷準備処理未実行の明細のみ…「未」
        // 出荷準備処理未実行、実行済の明細が混在(有出無残の場合など)…「一部済」
        // 出荷準備処理実行済の明細のみ…「済」
        $shippingPreparationFlg = '未';
        $shippingPreparationFlgCount = 0;

        if (is_null($trnOrderReceiveDetails)) {
            return $shippingPreparationFlg;
        }
        foreach ($trnOrderReceiveDetails as $trnOrderReceiveDetail) {
            if ($trnOrderReceiveDetail->shipping_preparation_flg == 1) {
                $shippingPreparationFlgCount++;
            }
        }
        if ($shippingPreparationFlgCount == count($trnOrderReceiveDetails)) {
            $shippingPreparationFlg = '済';
        } elseif ($shippingPreparationFlgCount > 0) {
            $shippingPreparationFlg = '一部済';
        }

        return $shippingPreparationFlg;
    }

    public function getPickingListOutputFlg()
    {
        $trnOrderReceiveDetails = $this->trnOrderReceiveDetails;
        $pickingListOutputFlg = '未';
        $pickingListOutputFlgCount = 0;

        if (is_null($trnOrderReceiveDetails)) {
          return $pickingListOutputFlg;
        }
        foreach ($trnOrderReceiveDetails as $trnOrderReceiveDetail) {
            if ($trnOrderReceiveDetail->picking_list_output_flg == 1) {
                $pickingListOutputFlgCount++;
            }
        }
        if ($pickingListOutputFlgCount == count($trnOrderReceiveDetails)) {
            $pickingListOutputFlg = '済';
        } elseif ($pickingListOutputFlgCount > 0) {
            $pickingListOutputFlg = '一部済';
        }

        return $pickingListOutputFlg;
    }

    public function getCheckStatusAttribute()
    {
        $trnShippingInspectionHeaders = $this->trnShippingInspectionHeaders;
        $checkStatus = '未';
        $checkStatusCount = 0;

        if (is_null($trnShippingInspectionHeaders)) {
            return $checkStatus;
        }
        foreach ($trnShippingInspectionHeaders as $trnShippingInspectionHeader) {
            if ($trnShippingInspectionHeader->inspection_flg == 1) {
                $checkStatusCount++;
            }
        }
        if ($checkStatusCount == count($trnShippingInspectionHeaders)) {
            $checkStatus = '済';
        } elseif ($checkStatusCount > 0) {
            $checkStatus = '一部済';
        }

        return $checkStatus;
    }

    public function getSalesDetailStatusAttribute()
    {
        $trnOrderReceiveDetails = $this->trnOrderReceiveDetails;
        $salesDetailStatus = '未';
        $salesDetailStatusCount = 0;

        if (is_null($trnOrderReceiveDetails)) {
            return $salesDetailStatus;
        }
        foreach ($trnOrderReceiveDetails as $trnOrderReceiveDetail) {
          $saleDetail = $trnOrderReceiveDetail->trnSaleDetail;
            if (!is_null($saleDetail)) {
                $salesDetailStatusCount++;
            }
        }
        if ($salesDetailStatusCount == count($trnOrderReceiveDetails)) {
            $salesDetailStatus = '済';
        } elseif ($salesDetailStatusCount > 0) {
            $salesDetailStatus = '一部済';
        }

        return $salesDetailStatus;
    }

    public function getTotalPickingListOutputFlg()
    {
        $trnOrderReceiveDetails = $this->trnOrderReceiveDetails;
        $totalPickingListOutputFlg = '未';
        $totalPickingListOutputFlgCount = 0;

        if (is_null($trnOrderReceiveDetails)) {
            return $totalPickingListOutputFlg;
        }
        foreach ($trnOrderReceiveDetails as $trnOrderReceiveDetail) {
            if ($trnOrderReceiveDetail->total_picking_list_output_flg == 1) {
                $totalPickingListOutputFlgCount++;
            }
        }
        if ($totalPickingListOutputFlgCount == count($trnOrderReceiveDetails)) {
            $totalPickingListOutputFlg = '済';
        }

        return $totalPickingListOutputFlg;
    }

    public function getShippingKbnNameAttribute()
    {
      switch ($this->shipping_kbn) {
        case 1:
          return '商品在庫有';
        case 2:
          return '有出無残';
        case 3:
          return '揃出';
        default:
          return '';
      }
    }

    public function getLimitAmountAttribute()
    {
      $credit_limit_amount_check_flg = $this->mtCustomer->credit_limit_amount_check_flg;
      if ($credit_limit_amount_check_flg == 0) {
        return '-';
      } else {
        $mtBillingAddress = $this->mtCustomer->mtBillingAddress;
        return $mtBillingAddress->credit_limit_amount;
      }
    }

    public function getProcessKbnNameAttribute()
    {
      switch ($this->process_kbn) {
        case 0:
          return 'なし';
        case 1:
          return '未確定';
        case 2:
          return '揃出';
        case 3:
          return '有出無残';
        case 4:
          return '他';
        default:
          return '';
      }
    }

    /**
     * IDによるNumber取得
     * @param $id
     * @return $model
     */
    static public function getNumberById($id)
    {
        return self::query()->select('order_receive_number')->where('id', $id)->first();
    }

    /**
     * NumberによるID取得
     * @param $number
     * @return $model
     */
    static public function getIdByNumber($number)
    {
        return self::query()->select('id')->where('order_receive_number', $number)->first();
    }
}
