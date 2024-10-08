<?php

namespace App\Repositories\MtBank;

use App\Models\MtBank;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtBankRepository implements MtBankRepositoryInterface
{

    /**
     * 銀行情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtBank::paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 銀行情報取得 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtBank::orderBy('bank_cd')->get();
        return $result;
    }

    /**
     * 銀行情報取得 削除
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtBank::where('id', $id)->delete();
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 銀行情報取得 更新
     * @param $param
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $j = 0;
            foreach ($params['update_id'] as $param) {
                if (!empty($params['update_bank_code'][$j])) {
                    $mtBank = new MtBank();
                    $mtBank = MtBank::where('id', $param)->first();
                    //変更の有無を確認
                    if (
                        isset($mtBank) &&
                        $mtBank['bank_cd'] === $params['update_bank_code'][$j] &&
                        $mtBank['bank_name'] === $params['update_bank_name'][$j]
                    ) {
                        $j++;
                        continue; //変更がない場合、更新を行わない
                    }
                    $mtBank->bank_cd = $params['update_bank_code'][$j];
                    $mtBank->bank_name = $params['update_bank_name'][$j];
                    $mtBank->mt_user_last_update_id = Auth::user()->id;
                    $mtBank->save();
                }
                $j++;
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_bank_code'][$i])) {
                    $mtBank = new MtBank();
                    $mtBank->bank_cd = $params['insert_bank_code'][$i];
                    $mtBank->bank_name = $params['insert_bank_name'][$i];
                    $mtBank->mt_user_last_update_id = Auth::user()->id;
                    $mtBank->save();
                }
                $i++;
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 銀行情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['bank_cd'] ? CodeUtil::pad($params['bank_cd'], 4) : null;
        $name = $params['bank_name'] ?? null;

        $query = MtBank::query();
        $query->when($code, fn($query) => $query->where("bank_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("bank_name", 'like', "%$name%"));
        $query->orderBy('bank_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 銀行情報リスト  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 4, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ';
        $result = MtBank::whereBetween("bank_cd", [$startCode, $endCode])
            ->orderBy("bank_cd")
            ->get();
        return $result;
    }

    /**
     * 銀行 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['bank_cd'] ? CodeUtil::pad($params['bank_cd'], 4) : null;

        $query = MtBank::query();
        $query->where('bank_cd', $code);

        return $query->first();
    }
}
