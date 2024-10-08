<?php

namespace App\Repositories\DefTaxRateKbn;

use App\Models\DefTaxRateKbn;
use App\Models\MtTaxRateSetting;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class DefTaxRateKbnRepository implements DefTaxRateKbnRepositoryInterface
{

  /**
   * 税率区分情報取得 全件取得
   * @return Object
   */
  public function getAll()
  {
    $result = DefTaxRateKbn::orderBy('sort_order')->paginate(CommonConsts::PAGINATION);
    return $result;
  }

  /**
   * 税率区分情報 名称補完(code指定)
   * @param $code
   * @return Object
   */
  public function getByCode($code)
  {
    $result = DefTaxRateKbn::where('tax_rate_kbn_cd', $code)->first();
    return $result;
  }

  /**
   * コード 名称補完(code指定)
   * @param $code
   * @return Object
   */
  public function getByCodeWithRate($code)
  {
    $result = DefTaxRateKbn::where('tax_rate_kbn_cd', $code)->first();
    $currentDateTime = date('Y-m-d');
    if (isset($result['id'])) {
      $result['rate'] = MtTaxRateSetting::where('def_tax_rate_kbn_id', $result['id'])
        ->whereDate('application_start_date', '<=', $currentDateTime)
        ->orderBy('application_start_date', 'DESC')->first();
    }

    return $result;
  }
}
