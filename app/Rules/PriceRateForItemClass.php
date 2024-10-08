<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PriceRateForItemClass implements ValidationRule
{
    private $rate;
    private $startYear;
    private $startMonth;
    private $startDay;
    private $endYear;
    private $endMonth;
    private $endDay;

    public function __construct()
    {
        $this->rate = __('validation.attributes.mt_customer_other_item_class_rates.rate');
        $this->startYear = __('validation.attributes.mt_customer_other_item_class_rates.start.year');
        $this->startMonth = __('validation.attributes.mt_customer_other_item_class_rates.start.month');
        $this->startDay = __('validation.attributes.mt_customer_other_item_class_rates.start.day');
        $this->endYear = __('validation.attributes.mt_customer_other_item_class_rates.end.year');
        $this->endMonth = __('validation.attributes.mt_customer_other_item_class_rates.end.month');
        $this->endDay = __('validation.attributes.mt_customer_other_item_class_rates.end.day');
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->validateRate($attribute, $value, $fail);
        $this->validateStartYear($attribute, $value, $fail);
    }

    private function validateRate(string $attribute, mixed $value, Closure $fail)
    {
        if ($this->requiredIfNewRegistrationForRate($value, $fail)) return; // この検証のためにこのクラスが必要
        if ($this->requiredWithStartYearForRate($value, $fail)) return;
        if ($this->requiredWithStartMonthForRate($value, $fail)) return;
        if ($this->requiredWithStartDayForRate($value, $fail)) return;
        if ($this->requiredWithEndYearForRate($value, $fail)) return;
        if ($this->requiredWithEndMonthForRate($value, $fail)) return;
        if ($this->requiredWithEndDayForRate($value, $fail)) return;
    }

    private function validateStartYear(string $attribute, mixed $value, Closure $fail)
    {
        if ($this->requiredIfNewRegistrationForStartYear($value, $fail)) return; // この検証のためにこのクラスが必要
        if ($this->requiredWithRateForStartYear($value, $fail)) return;
        if ($this->requiredWithStartMonthForStartYear($value, $fail)) return;
        if ($this->requiredWithStartDayForStartYear($value, $fail)) return;
        if ($this->requiredWithEndYearForStartYear($value, $fail)) return;
        if ($this->requiredWithEndMonthForStartYear($value, $fail)) return;
        if ($this->requiredWithEndDayForStartYear($value, $fail)) return;
    }

    private function isNewRegistration($value)
    {
        return is_null($value['mt_customer_other_item_class_rate_id'])
            && !is_null($value['item_class_cd']);
    }

    private function requiredIfNewRegistrationForRate($value, $fail)
    {
        if (is_null($value['rate']) && $this->isNewRegistration($value)) {
            $fail('掛率 はブランド１を新規登録する場合には必須です');
            return true;
        }
        return false;
    }

    private function requiredWithStartYearForRate($value, $fail)
    {
        if (is_null($value['rate']) && !is_null($value['start']['year'])) {
            $fail(__('validation.required_with', ['attribute' => '掛率', 'values' => $this->startYear]));
            return true;
        }
        return false;
    }

    private function requiredWithStartMonthForRate($value, $fail)
    {
        if (is_null($value['rate']) && !is_null($value['start']['month'])) {
            $fail(__('validation.required_with', ['attribute' => '掛率', 'values' => $this->startMonth]));
            return true;
        }
        return false;
    }

    private function requiredWithStartDayForRate($value, $fail)
    {
        if (is_null($value['rate']) && !is_null($value['start']['day'])) {
            $fail(__('validation.required_with', ['attribute' => '掛率', 'values' => $this->startDay]));
            return true;
        }
        return false;
    }

    private function requiredWithEndYearForRate($value, $fail)
    {
        if (is_null($value['rate']) && !is_null($value['end']['year'])) {
            $fail(__('validation.required_with', ['attribute' => '掛率', 'values' => $this->endYear]));
            return true;
        }
        return false;
    }

    private function requiredWithEndMonthForRate($value, $fail)
    {
        if (is_null($value['rate']) && !is_null($value['end']['month'])) {
            $fail(__('validation.required_with', ['attribute' => '掛率', 'values' => $this->endMonth]));
            return true;
        }
        return false;
    }

    private function requiredWithEndDayForRate($value, $fail)
    {
        if (is_null($value['rate']) && !is_null($value['end']['day'])) {
            $fail(__('validation.required_with', ['attribute' => '掛率', 'values' => $this->endDay]));
            return true;
        }
        return false;
    }

    private function requiredIfNewRegistrationForStartYear($value, $fail)
    {
        if (is_null($value['start']['year']) && $this->isNewRegistration($value)) {
            $fail('開始日付 年 はブランド１を新規登録する場合には必須です');
            return true;
        }
        return false;
    }

    private function requiredWithRateForStartYear($value, $fail)
    {
        if (is_null($value['start']['year']) && !is_null($value['rate'])) {
            $fail(__('validation.required_with', ['attribute' => '開始日付 年', 'values' => $this->rate]));
            return true;
        }
        return false;
    }

    private function requiredWithStartMonthForStartYear($value, $fail)
    {
        if (is_null($value['start']['year']) && !is_null($value['start']['month'])) {
            $fail(__('validation.required_with', ['attribute' => '開始日付 年', 'values' => $this->startMonth]));
            return true;
        }
        return false;
    }

    private function requiredWithStartDayForStartYear($value, $fail)
    {
        if (is_null($value['start']['year']) && !is_null($value['start']['day'])) {
            $fail(__('validation.required_with', ['attribute' => '開始日付 年', 'values' => $this->startDay]));
            return true;
        }
        return false;
    }

    private function requiredWithEndYearForStartYear($value, $fail)
    {
        if (is_null($value['start']['year']) && !is_null($value['end']['year'])) {
            $fail(__('validation.required_with', ['attribute' => '開始日付 年', 'values' => $this->endYear]));
            return true;
        }
        return false;
    }

    private function requiredWithEndMonthForStartYear($value, $fail)
    {
        if (is_null($value['start']['year']) && !is_null($value['end']['month'])) {
            $fail(__('validation.required_with', ['attribute' => '開始日付 年', 'values' => $this->endMonth]));
            return true;
        }
        return false;
    }

    private function requiredWithEndDayForStartYear($value, $fail)
    {
        if (is_null($value['start']['year']) && !is_null($value['end']['day'])) {
            $fail(__('validation.required_with', ['attribute' => '開始日付 年', 'values' => $this->endDay]));
            return true;
        }
        return false;
    }
}
