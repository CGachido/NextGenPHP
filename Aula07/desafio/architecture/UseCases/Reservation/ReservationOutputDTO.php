<?php

namespace Architecture\UseCases\Reservation;

use DateTimeImmutable;

class ReservationOutputDTO
{
    public function __construct(
        public int $id,
        public int $userId,
        public int $storedBookId,
        public DateTimeImmutable $reservedAt,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'stored_book_id' => $this->storedBookId,
            'reserved_at' => $this->reservedAt,
            'updated_at' => $this->createdAt,
            'created_at' => $this->updatedAt,
        ];
    }
}
