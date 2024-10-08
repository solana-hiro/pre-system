<?php
namespace App\Repositories\MtSize;

interface MtSizeRepositoryInterface
{
    /**
     * サイズパターン情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * サイズマスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * サイズ情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * サイズリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
