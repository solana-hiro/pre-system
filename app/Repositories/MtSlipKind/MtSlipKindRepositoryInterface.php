<?php
namespace App\Repositories\MtSlipKind;

interface MtSlipKindRepositoryInterface
{
    /**
     * 伝票種別情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 伝票種別情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
