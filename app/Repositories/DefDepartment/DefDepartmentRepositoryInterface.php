<?php
namespace App\Repositories\DefDepartment;

interface DefDepartmentRepositoryInterface
{
	    /**
     * 部門情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 部門情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);
}
