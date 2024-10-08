<?php
namespace App\Repositories\MtCatalog;

interface MtCatalogRepositoryInterface
{
	/* カタログ情報取得 全件取得*/
    public function getAll();

	/* カタログ情報取得 指定条件にて取得 */
    public function get($params);
}
