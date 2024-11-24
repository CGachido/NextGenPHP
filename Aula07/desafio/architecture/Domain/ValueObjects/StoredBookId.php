<?php

namespace Architecture\Domain\ValueObjects;

class StoredBookId
{
    public function __construct(protected int $value)
    {
        $this->isValidId($value);
    }

    private function isValidId(int $value): bool
    {
        if ($value < 1) {
            throw new \InvalidArgumentException('Invalid Stored Book Id number');
        }
        return true;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
