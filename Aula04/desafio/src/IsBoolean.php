<?php

declare(strict_types=1);

namespace DifferDev;

use DifferDev\Interfaces\Validator;

class IsBoolean implements Validator
{
    public function validate(string|bool $value): bool
    {
        $string = $value === false ? "false" : (string) $value;
        return (bool) preg_match('/^(true|false|0|1)$/i', $string);
    }
}
