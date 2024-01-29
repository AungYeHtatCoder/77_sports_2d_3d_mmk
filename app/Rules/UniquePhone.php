<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniquePhone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $countryCode = request()->input('country_code');
        $exists = User::where('country_code', $countryCode)->where('phone', $value)->exists();
        if (!$exists) {
            $fail('The phone is not registered yet.');
        }
    }
}
