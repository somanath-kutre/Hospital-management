<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AmountNotGreaterThanFeesRule implements Rule
{
    private $fees;

    public function __construct($fees)
    {
        $this->fees = $fees;
    }

    public function passes($attribute, $value)
    {
        return $value <= $this->fees;
    }

    public function message()
    {
        // return "The :attribute must not be greater than $this->fees.";
        return "The bill amount must not be greater than $this->fees.";
    }
}
