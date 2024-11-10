<?php

declare(strict_types=1);

namespace DifferDev;

use DifferDev\Interfaces\Validator;
use InvalidArgumentException;

class IsEven implements Validator
{
    public function validate(string $value): bool
    {
        if (!$this->validateInteger($value)) {
            throw new InvalidArgumentException("Invalid integer number");
        }
        return !($value % 2);
    }

    private function validateInteger(string $number): bool
    {
        return (bool) \preg_match('/^[+-]?\d+$/', $number);
    }
}
