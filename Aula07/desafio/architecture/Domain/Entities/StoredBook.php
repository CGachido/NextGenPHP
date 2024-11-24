<?php

namespace Architecture\Domain\Entities;

use DateTimeImmutable;

class StoredBook
{
    public function __construct(
        protected int $id,
        protected int $bookId,
        protected DateTimeImmutable $createdAt,
        protected DateTimeImmutable $updatedAt
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['book_id'],
            new DateTimeImmutable($data['created_at']),
            new DateTimeImmutable($data['updated_at'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'book_id' => $this->bookId,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
