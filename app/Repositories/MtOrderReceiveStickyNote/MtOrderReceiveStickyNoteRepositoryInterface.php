<?php
namespace App\Repositories\MtOrderReceiveStickyNote;

interface MtOrderReceiveStickyNoteRepositoryInterface
{
    /**
     * 受付付箋取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 受付付箋取得(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 受付付箋取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
