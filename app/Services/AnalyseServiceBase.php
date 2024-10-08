<?php

namespace App\Services;

class AnalyseServiceBase
{
    protected function isContainSortParam($params)
    {
        if (isset($params["search"])) {
            $orderKey = explode('-', $params["search"]);
            return count($orderKey) == 2;
        } else {
            return false;
        }
    }

    protected function sortByParams($sortElement, $params)
    {
        if ($this->isContainSortParam($params)) {
            $orderKey = explode('-', $params["search"]);
            $sortElement = [[$orderKey[1], $orderKey[0]], ...$sortElement];
        }
        return $sortElement;
    }
}
