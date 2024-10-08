<?php

namespace App\Rules;

use App\Repositories\MtSlipKind\MtSlipKindRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistSlipKindForShippingLabel implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $service = new MtSlipKindRepository();
        if (!$service->isExist($value, '07')) {
            $fail(__('validation.custom.not_exist_slip_kind'));
        }
    }
}
