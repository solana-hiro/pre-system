<?php

namespace App\Rules;

use App\Services\MtWarehouseService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistWarehouse implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $service = new MtWarehouseService();
        if (!$service->isExist($value)) {
            $fail('validation.custom.attribute.warehouse_cd');
        }
    }
}
