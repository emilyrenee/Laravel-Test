<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class FullName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $pattern = '/\s/';
        $hasSpace = preg_match($pattern, $value);

        // ensure all words are capitalized
        $exploded = explode(' ', $value);
        $testName = '';
        foreach ($exploded as $explode) {
            $testName = trim($testName) . ' ' . ucfirst($explode);
        }
        $isCapitalized = $testName === $value;

        if ($hasSpace && $isCapitalized) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Name should include a captitalized First Name and Last Name with a space between.';
    }
}
