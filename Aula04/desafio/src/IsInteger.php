<?php

declare(strict_types=1);

namespace DifferDev;

use DifferDev\Interfaces\Validator;

class IsInteger implements Validator
{
    public function validate(string $value): bool
    {
        return (bool) \preg_match('/^[+-]?\d+$/', $value);
    }
}
