<?php

namespace App\GraphQL\Directives;

use App\Rules\Pesel;
use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateUserValidationDirective extends ValidationDirective
{
    /**
     * Name of the directive.
     *
     * @return string
     */
    public function name(): string
    {
        return 'updateUserValidation';
    }

    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            'name' => 'string|min:4|max:100',
            'email' => [
                'email',
                'max:100',
                Rule::unique('users')->ignore($this->args['id'], 'id'),
            ],
            'password' => 'string|min:8|max:255',
            'pesel' => [
                'string',
                'filled',
                'min:11',
                'max:11',
                Rule::unique('users')->ignore($this->args['id'], 'id'),
                new Pesel,
            ],
            'phone' => 'string|min:4|max:50',
            'address' => 'string|max:100',
            'photo' => 'file|image|mimes:jpeg,png,gif,webp',
        ];
    }
}
