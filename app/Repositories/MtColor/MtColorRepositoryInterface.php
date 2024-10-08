<?php
namespace App\Repositories\MtColor;

interface MtColorRepositoryInterface
{
    /**
     * カラーパターン情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * カラーマスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * カラー情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * カラーリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
