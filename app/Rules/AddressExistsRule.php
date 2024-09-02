<?php

namespace App\Rules;

use App\Models\City;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AddressExistsRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->exists($value)) {
            $fail('The selected :attribute is invalid. One or more of the provided addresses could not be found in the database.');
        }
    }

    protected function exists(array $value): bool
    {
        return City::query()
            ->where('country', $value['country'])
            ->where('zipCode', $value['zip'])
            ->where('name', $value['city'])
            ->exists();
    }
}
