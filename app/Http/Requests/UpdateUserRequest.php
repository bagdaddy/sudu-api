<?php

namespace App\Http\Requests;

use App\Enums\CountryEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'string',
            'username' => 'string',
            'image' => 'string',
            'country' => [new EnumValue(CountryEnum::class)],
            'is_public' => 'boolean',
        ];
    }
}
