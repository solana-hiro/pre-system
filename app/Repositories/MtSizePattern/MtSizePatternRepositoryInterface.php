<?php
namespace App\Repositories\MtSizePattern;

interface MtSizePatternRepositoryInterface
{
    /**
     * サイズパターン情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * サイズパターンマスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update(array $params);

    /**
     * サイズパターン情報取得 指定条件にて取得
     * @param $params
     * @return Object
     */
    public function get(array $params);

    /**
     * サイズパターンリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export(array $params);
}
