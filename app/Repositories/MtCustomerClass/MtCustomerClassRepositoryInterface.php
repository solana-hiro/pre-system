<?php
namespace App\Repositories\MtCustomerClass;

interface MtCustomerClassRepositoryInterface
{
    public function getAll();
    public function update(array $params);
    public function delete(int $id);
    public function export(array $params);
    /**
     * ランク3の全件取得
     * @return Object
     */
    public function getAllRank3();

    /**
     * ランク3の取得(条件)
     * @param $params
     * @return Object
     */
    public function getRank3($params);

    /**
     * 業種・特徴2の全件取得
     * @return Object
     */
    public function getAllIndustry();


    /**
     * 業種・特徴2の取得(条件)
     * @param $params
     * @return Object
     */
    public function getIndustry($params);
}
