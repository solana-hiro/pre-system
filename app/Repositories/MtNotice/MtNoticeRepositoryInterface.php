<?php
namespace App\Repositories\MtNotice;

interface MtNoticeRepositoryInterface
{
	/* お知らせ情報取得 全件取得*/
    public function getAll();

	/* お知らせ情報取得 指定条件にて取得 */
    public function get($params);
}
