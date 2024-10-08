<?php
namespace App\Repositories\DefPsKbn;

interface DefPsKbnRepositoryInterface
{
	/* PS区分情報取得 全件取得*/
    public function getAll();

	/* PS区分情報取得 指定条件にて取得 */
    public function get($params);
}
