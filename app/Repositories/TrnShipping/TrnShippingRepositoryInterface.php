<?php
namespace App\Repositories\TrnShippingInspectionHeader;

interface TrnShippingInspectionHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 出荷指示の情報取得 */
    public function getShippingInstructionOutput(array $params);

	/* 出荷指示の情報更新 */
    public function updateShippingInstructionInput(array $params);

}
