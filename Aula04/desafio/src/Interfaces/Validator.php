<?php

declare(strict_types=1);

namespace DifferDev\Interfaces;

interface Validator
{
    public function validate(string $value): bool;
}
