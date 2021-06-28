<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Birthday implements Rule
{
    private $values;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($values)
    {
        $this->values = $values;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $birthdayValues = [];

        foreach (['month', 'day', 'year'] as $suffix) {
            $birthdayValues[] = $this->values["birth_$suffix"];
        }

        return checkdate(...$birthdayValues);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '生年月日に誤りがあります';
    }
}