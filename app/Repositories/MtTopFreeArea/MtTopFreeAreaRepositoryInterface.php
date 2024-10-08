<?php
namespace App\Repositories\MtTopFreeArea;

interface MtTopFreeAreaRepositoryInterface
{
	/* TOP自由領域情報取得 全件取得*/
    public function getAll();

	/* TOP自由領域情報取得 指定条件にて取得 */
    public function get($params);
}
