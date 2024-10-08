<?php

namespace App\Services;

use App\Repositories\MtSizePattern\MtSizePatternRepository;
use App\Http\Resources\MtSizePattern\MtSizePatternListResource;
use Illuminate\Support\Facades\Log;

/**
 * サイズパターン関連 サービスクラス
 */
class MtSizePatternService
{

    /**
     * @var MtSizePatternRepository
     */
    private MtSizePatternRepository $mtSizePatternRepository;

    /**
     * @param MtSizePatternRepository $mtSizePatternRepository
     */
    public function __construct()
    {
        $this->mtSizePatternRepository = new MtSizePatternRepository();
    }

    /** サイズパターン  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtSizePatternRepository->getAll();
        return $datas;
    }

    /** サイズパターン  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtSizePatternRepository->getInitData();
        return $datas;
    }

    /** サイズパターンマスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtSizePatternRepository->update($params);
        return $datas;
    }

    /** サイズパターン  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtSizePatternRepository->delete($id);
        return $datas;
    }


    /** サイズパターン  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtSizePatternRepository->get($params);
        return $datas;
    }

    /** サイズパターンリスト(一覧)  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtSizePatternRepository->export($params);
        $datas = MtSizePatternListResource::collection($result);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtSizePatternRepository->getByCode($params);
        return $datas;
    }
}
