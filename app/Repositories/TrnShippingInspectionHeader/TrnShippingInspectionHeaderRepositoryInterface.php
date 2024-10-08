<?php
namespace App\Repositories\TrnShippingInspectionHeader;

interface TrnShippingInspectionHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 出荷案内発行の情報取得 */
    public function getGuidanceIssue(array $params);

	/* 出荷検品情報の情報取得 */
    public function getInspection(array $params);

	/* 出荷検品情報の更新 */
    public function updateInspection(array $params);

	/* 出荷検品情報の手検品 */
    public function executeInspection(array $params);

	/* トータルピッキングリスト発行の情報取得 */
    public function getTotalPickingList(array $params);

	/* ピッキングリスト発行の情報取得 */
    public function getPickingList(array $params);

}
