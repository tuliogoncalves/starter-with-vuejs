<?php

namespace App\Repositories;

use Scriptpage\Repository\Validation;
use Illuminate\Contracts\Validation\Validator as IValidator;

class UserUpdate extends Validation
{
    public function authorize() {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'max:50',
            'email' => 'email|min:10'
        ];
    }

    public function setDataPayload(array $data=[])
    {
        $this->fill($data);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    public function withValidator(IValidator $validator)
    {
        return true;
    }
}