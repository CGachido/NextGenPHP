<?php

declare(strict_types=1);

namespace DifferDev;

use DifferDev\Interfaces\Validator;
use Exception;
use InvalidArgumentException;

class IsGreaterThan implements Validator
{
    public function __construct(protected string $number)
    {
        if (!$this->validateAsNumber($number)) {
            throw new InvalidArgumentException("Invalid number");
        }
    }

    public function validate(string $comparer): bool
    {
        $this->validateAsNumber($comparer);

        return $comparer > $this->number;
    }

    private function validateAsNumber(string $number)
    {
        return $this->validateFloat($number) || $this->validateInteger($number);
    }

    private function validateFloat(string $number): bool
    {
        // Regex que valida se é string com número quebrado '3.4'
        return (bool)preg_match('/^[+-]?(\d+\.\d+|\d+\.[eE][+-]?\d+|\.\d+|\d+\.\d*)([eE][+-]?\d+)?$/', $number);
    }

    private function validateInteger(string $number): bool
    {
        return (bool) \preg_match('/^[+-]?\d+$/', $number);
    }
}
