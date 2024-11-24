<?php

namespace Architecture\Domain\ValueObjects;

class UserId
{
    public function __construct(protected int $value)
    {
        $this->isValidId($value);
    }

    private function isValidId(int $value): bool
    {
        if ($value < 1) {
            throw new \InvalidArgumentException('Invalid User Id number');
        }
        return true;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
