<?php
namespace App\Repositories\MtCustomer;

interface MtCustomerRepositoryInterface
{
    /* 得意先マスタ 全件取得 */
    public function getAll();

    /* 得意先マスタ 条件取得 */
    public function get($params);

	/* 得意先マスタ 取得(id指定) */
    public function getById($id);

    /* 得意先マスタ 更新 */
    public function update($id, array $params);

    /* 得意先マスタ 残高取得 */
    public function getBalance($id);

    /* 得意先マスタ 残高更新 実装不要　*/
    //public function updateBalance($id, array $params);

    /* 得意先リスト 取得 */
    public function export(array $params);
}
