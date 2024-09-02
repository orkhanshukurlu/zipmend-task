<?php

namespace App\Http\Requests;

use App\Rules\AddressExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class CalculateRoutePriceRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'addresses' => 'Addresses',
            'addresses.*' => 'Addresses list',
            'addresses.*.country' => 'Country',
            'addresses.*.zip' => 'Zip',
            'addresses.*.city' => 'City',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'addresses' => [
                'required',
                'array',
                'min:2',
            ],
            'addresses.*' => [
                'required',
                'array',
                'size:3',
                new AddressExistsRule(),
            ],
            'addresses.*.country' => [
                'required',
                'string',
            ],
            'addresses.*.zip' => [
                'required',
                'string',
            ],
            'addresses.*.city' => [
                'required',
                'string',
            ],
        ];
    }
}
