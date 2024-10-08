<?php
namespace App\Repositories\TrnOrderReceiveHeader;

interface TrnOrderReceiveHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 受注問合せの情報取得 */
    public function getAccountantInquiry(array $params);

	/* 入出荷予定問合せの情報取得 */
    public function getShippingInquiry(array $params);

	/* 入出荷予定問合せの出力内容取得 */
    //public function exportShippingInquiry(array $params);

}
