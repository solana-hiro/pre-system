<?php
namespace App\Repositories\TrnOrderDetail;

interface TrnOrderDetailRepositoryInterface
{
	/* 全件 */

    public function getAll();
    public function get( array $params);


}
