<?php
namespace App\Repositories\TrnShipping;

use App\Models\TrnShipping;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class TrnShippingRepository implements TrnShippingRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnShipping::get();
		return $result;
    }

    /**
     * 出荷指示の情報取得
     * @param array $params
     * @return Object
     */
     public function getShippingInstructionOutput(array $params) {
     	$result = TrnShipping::get();
        return $result;
     }

    /**
     * 出荷指示の情報更新
     * @param array $params
     * @return Object
     */
     public function updateShippingInstructionInput(array $params) {
     	$result = TrnShipping::get();
        return $result;
     }

}
