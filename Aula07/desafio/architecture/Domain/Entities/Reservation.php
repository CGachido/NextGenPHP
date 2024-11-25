<?php

namespace Architecture\Domain\Entities;

use DateTimeImmutable;

class Reservation
{
    public function __construct(
        protected User $user,
        protected StoredBook $storedBook,
        protected DateTimeImmutable $reservedAt,
        protected ?DateTimeImmutable $createdAt = null,
        protected ?DateTimeImmutable $updatedAt = null,
        protected ?DateTimeImmutable $returnedAt = null,
        protected ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user'],
            $data['stored_book'],
            new DateTimeImmutable($data['reserved_at']),
            new DateTimeImmutable($data['created_at']),
            new DateTimeImmutable($data['updated_at']),
            !empty($data['returned_at']) ? new DateTimeImmutable($data['returned_at']) : null,
            $data['id'],
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
            'returned_at' => $this->returnedAt ? $this->returnedAt->format('Y-m-d H:i:s') : null,
        ];
    }

    public function getReturnedAt(): ?string
    {
        return $this->returnedAt ? $this->returnedAt->format('Y-m-d H:i:s') : null;
    }

    public function getReservedAt(): ?string
    {
        return $this->reservedAt ? $this->reservedAt->format('Y-m-d H:i:s') : null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setReturnedAt(DateTimeImmutable $returnedAt): void
    {
        $this->validateReturnedAtDate($returnedAt);
        $this->returnedAt = $returnedAt;
    }

    private function validateReturnedAtDate(?DateTimeImmutable $returnedAt)
    {
        if (empty($returnedAt)) {
            return false;
        }

        if ($this->reservedAt >= $returnedAt) {
            throw new \Exception("Return date must be greater than reserved date!", 403);
        }

        if ($returnedAt >= new DateTimeImmutable()) {
            throw new \Exception("Return date cannot be a future date!", 403);
        }
    }
}
