<?php

declare(strict_types=1);

namespace DifferDev;

use DifferDev\Interfaces\Validator;

class IsFloat implements Validator
{
    public function validate(string $value): bool
    {
        return (bool)preg_match('/^[+-]?(\d+\.\d+|\d+\.[eE][+-]?\d+|\.\d+|\d+\.\d*)([eE][+-]?\d+)?$/', $value);
    }
}
