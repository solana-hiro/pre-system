<?php
namespace App\Repositories\MtColorPattern;

interface MtColorPatternRepositoryInterface
{
    /**
     * カラーパターン情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * カラーパターンマスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update(array $params);

    /**
     * カラーパターン情報取得 指定条件にて取得
     * @param $params
     * @return Object
     */
    public function get(array $params);

    /**
     * カラーパターンリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export(array $params);
}
