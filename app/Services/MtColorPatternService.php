<?php

namespace App\Services;

use App\Repositories\MtColorPattern\MtColorPatternRepository;
use App\Http\Resources\MtColorPattern\MtColorPatternListResource;
use Illuminate\Support\Facades\Log;

/**
 * カラーパターン関連 サービスクラス
 */
class MtColorPatternService
{

    /**
     * @var MtColorPatternRepository
     */
    private MtColorPatternRepository $mtColorPatternRepository;

    /**
     * @param MtColorPatternRepository $mtColorPatternRepository
     */
    public function __construct()
    {
        $this->mtColorPatternRepository = new MtColorPatternRepository();
    }

    /** カラーパターン  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtColorPatternRepository->getAll();
        return $datas;
    }

    /** カラーパターン  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtColorPatternRepository->getInitData();
        return $datas;
    }

    /** カラーパターン  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtColorPatternRepository->delete($id);
        return $datas;
    }

    /** カラーパターンマスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtColorPatternRepository->update($params);
        return $datas;
    }

    /** カラーパターン  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtColorPatternRepository->get($params);
        return $datas;
    }

    /** カラーパターンリスト(一覧)  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtColorPatternRepository->export($params);
        $datas = MtColorPatternListResource::collection($result);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtColorPatternRepository->getByCode($params);
        return $datas;
    }
}
