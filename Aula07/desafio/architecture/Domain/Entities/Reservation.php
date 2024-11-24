<?php

namespace Architecture\Domain\Entities;

use DateTimeImmutable;

class Reservation
{
    public function __construct(
        protected ?int $id = null,
        protected User $user,
        protected StoredBook $storedBook,
        protected DateTimeImmutable $reservedAt,
        protected ?DateTimeImmutable $createdAt = null,
        protected ?DateTimeImmutable $updatedAt = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['user'],
            $data['stored_book'],
            new DateTimeImmutable($data['reserved_at']),
            new DateTimeImmutable($data['created_at']),
            new DateTimeImmutable($data['updated_at']),
        );
    }

    public static function create(
        User $user,
        StoredBook $storedBook,
        DateTimeImmutable $reservedAt
    ) {
        return new self(
            id: null,
            user: $user,
            storedBook: $storedBook,
            reservedAt: $reservedAt
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->getId(),
            'stored_book_id' => $this->storedBook->getId(),
            'reserved_at' => $this->reservedAt->format('Y-m-d H:i:s'),
            'created_at' => $this->createdAt ? $this->createdAt->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->updatedAt ? $this->updatedAt->format('Y-m-d H:i:s') : null,
        ];
    }
}
