<?php

namespace App\Repositories\Analyse;

use App\Lib\DateUtil;

class AnalyseRepositoryBase
{
    protected function orderByButton($params, $query)
    {
        if (isset($params["search"])) {
            $orderKey = explode('-', $params["search"]);
            if (count($orderKey) == 1) return $query;

            return $query->orderBy($orderKey[1], $orderKey[0]);
        } else {
            return $query;
        }
    }

    protected function filterByValue($params, $query, $table, $column)
    {
        switch ($params["{$column}_filter_condition"]) {
            case 'none':
                return $query;
            case 'eq':
                return $this->filterByValueEq($params, $query, $table, $column);
            case 'ne':
                return $this->filterByValueNe($params, $query, $table, $column);
            case 'gt':
                return $this->filterByValueGt($params, $query, $table, $column);
            case 'lt':
                return $this->filterByValueLt($params, $query, $table, $column);
            case 'ge':
                return $this->filterByValueGe($params, $query, $table, $column);
            case 'le':
                return $this->filterByValueLe($params, $query, $table, $column);
            case 'like':
                return $this->filterByValueLike($params, $query, $table, $column);
            case 'not_like':
                return $this->filterByValueNotLike($params, $query, $table, $column);
            case 'sw':
                return $this->filterByValueSw($params, $query, $table, $column);
            case 'ew':
                return $this->filterByValueEw($params, $query, $table, $column);
            case 'between':
                return $this->filterByValueBetween($params, $query, $table, $column);
        }
    }

    protected function filterByDate($params, $query, $table, $column)
    {
        switch ($params["{$column}_filter_condition"]) {
            case 'none':
                return $query;
            case 'eq':
                return $this->isFirstMonthlyFlagOn($params, $column)
                    ? $this->filterByDateEqForMonthlyFlagOn($params, $query, $table, $column)
                    : $this->filterByDateEq($params, $query, $table, $column);
            case 'ne':
                return $this->isFirstMonthlyFlagOn($params, $column)
                    ? $this->filterByDateNeForMonthlyFlagOn($params, $query, $table, $column)
                    : $this->filterByDateNe($params, $query, $table, $column);
            case 'gt':
                return $this->isFirstMonthlyFlagOn($params, $column)
                    ? $this->filterByDateGtForMonthlyFlagOn($params, $query, $table, $column)
                    : $this->filterByDateGt($params, $query, $table, $column);
            case 'lt':
                return $this->isFirstMonthlyFlagOn($params, $column)
                    ? $this->filterByDateLtForMonthlyFlagOn($params, $query, $table, $column)
                    : $this->filterByDateLt($params, $query, $table, $column);
            case 'ge':
                return $this->isFirstMonthlyFlagOn($params, $column)
                    ? $this->filterByDateGeForMonthlyFlagOn($params, $query, $table, $column)
                    : $this->filterByDateGe($params, $query, $table, $column);
            case 'le':
                return $this->isFirstMonthlyFlagOn($params, $column)
                    ? $this->filterByDateLeForMonthlyFlagOn($params, $query, $table, $column)
                    : $this->filterByDateLe($params, $query, $table, $column);
            case 'between':
                return $this->filterByDateBetween($params, $query, $table, $column);
        }
    }

    private function isFirstMonthlyFlagOn($params, $column)
    {
        return array_key_exists("{$column}_filter_first_monthly_flag", $params)
            && $params["{$column}_filter_first_monthly_flag"] === 'on';
    }

    private function isSecondMonthlyFlagOn($params, $column)
    {
        return array_key_exists("{$column}_filter_second_monthly_flag", $params)
            && $params["{$column}_filter_second_monthly_flag"] === 'on';
    }

    private function filterByValueEq($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '=', $params["{$column}_filter_first"]);
    }

    private function filterByValueNe($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '!=', $params["{$column}_filter_first"]);
    }

    private function filterByValueGt($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '>', $params["{$column}_filter_first"]);
    }

    private function filterByValueLt($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '<', $params["{$column}_filter_first"]);
    }

    private function filterByValueGe($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '>=', $params["{$column}_filter_first"]);
    }

    private function filterByValueLe($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '<=', $params["{$column}_filter_first"]);
    }

    private function filterByValueLike($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", 'LIKE', '%' . $params["{$column}_filter_first"] . '%');
    }

    private function filterByValueNotLike($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", 'NOT LIKE', '%' . $params["{$column}_filter_first"] . '%');
    }

    private function filterByValueSw($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", 'LIKE', $params["{$column}_filter_first"] . '%');
    }

    private function filterByValueEw($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", 'LIKE', '%' . $params["{$column}_filter_first"]);
    }

    private function filterByValueBetween($params, $query, $table, $column)
    {
        return $query->whereBetween("{$table}.{$column}", [$params["{$column}_filter_first"], $params["{$column}_filter_second"]]);
    }

    private function filterByDateEq($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '=', $this->getFirstDate($params, $column));
    }

    private function filterByDateNe($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '!=', $this->getFirstDate($params, $column));
    }

    private function filterByDateGt($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '>', $this->getFirstDate($params, $column));
    }

    private function filterByDateLt($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '<', $this->getFirstDate($params, $column));
    }

    private function filterByDateGe($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '>=', $this->getFirstDate($params, $column));
    }

    private function filterByDateLe($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '<=', $this->getFirstDate($params, $column));
    }

    private function filterByDateBetween($params, $query, $table, $column)
    {
        $firstDate = $this->isFirstMonthlyFlagOn($params, $column)
            ? $this->getFirstBeginningOfMonth($params, $column)
            : $this->getFirstDate($params, $column);
        $secondDate = $this->isSecondMonthlyFlagOn($params, $column)
            ? $this->getSecondEndOfMonth($params, $column)
            : $this->getSecondDate($params, $column);
        return $query->whereBetween("{$table}.{$column}", [$firstDate, $secondDate]);
    }

    private function filterByDateEqForMonthlyFlagOn($params, $query, $table, $column)
    {
        return $query->whereBetween(
            "{$table}.{$column}",
            [
                $this->getFirstBeginningOfMonth($params, $column),
                $this->getFirstEndOfMonth($params, $column),
            ]
        );
    }

    private function filterByDateNeForMonthlyFlagOn($params, $query, $table, $column)
    {
        return $query->whereNotBetween(
            "{$table}.{$column}",
            [
                $this->getFirstBeginningOfMonth($params, $column),
                $this->getFirstEndOfMonth($params, $column),
            ]
        );
    }

    private function filterByDateGtForMonthlyFlagOn($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '>', $this->getFirstEndOfMonth($params, $column));
    }

    private function filterByDateLtForMonthlyFlagOn($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '<', $this->getFirstBeginningOfMonth($params, $column));
    }

    private function filterByDateGeForMonthlyFlagOn($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '>=', $this->getFirstBeginningOfMonth($params, $column));
    }

    private function filterByDateLeForMonthlyFlagOn($params, $query, $table, $column)
    {
        return $query->where("{$table}.{$column}", '<=', $this->getFirstEndOfMonth($params, $column));
    }

    private function getFirstDate($params, $column)
    {
        return DateUtil::paramToDateTimeString(
            'Y-n-j',
            $params["{$column}_filter_first_year"],
            $params["{$column}_filter_first_month"],
            $params["{$column}_filter_first_day"]
        );
    }

    private function getSecondDate($params, $column)
    {
        return DateUtil::paramToDateTimeString(
            'Y-n-j',
            $params["{$column}_filter_second_year"],
            $params["{$column}_filter_second_month"],
            $params["{$column}_filter_second_day"]
        );
    }

    private function getFirstBeginningOfMonth($params, $column)
    {
        return DateUtil::paramToDateTimeString(
            'Y-n-j',
            $params["{$column}_filter_first_year"],
            $params["{$column}_filter_first_month"],
            0,
        );
    }

    private function getFirstEndOfMonth($params, $column)
    {
        return DateUtil::paramToDateTimeString(
            'Y-n-j',
            $params["{$column}_filter_first_year"],
            $params["{$column}_filter_first_month"],
            99,
        );
    }

    private function getSecondBeginningOfMonth($params, $column)
    {
        return DateUtil::paramToDateTimeString(
            'Y-n-j',
            $params["{$column}_filter_second_year"],
            $params["{$column}_filter_second_month"],
            0,
        );
    }

    private function getSecondEndOfMonth($params, $column)
    {
        return DateUtil::paramToDateTimeString(
            'Y-n-j',
            $params["{$column}_filter_second_year"],
            $params["{$column}_filter_second_month"],
            99,
        );
    }
}
