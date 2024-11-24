<?php

namespace Architecture\Domain\Entities;

use DateTimeImmutable;

class User
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $email,
        protected ?DateTimeImmutable $emailVerifiedAt,
        protected DateTimeImmutable $createdAt,
        protected DateTimeImmutable $updatedAt
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
            isset($data['email_verified_at']) ? new DateTimeImmutable($data['email_verified_at']) : null,
            new DateTimeImmutable($data['created_at']),
            new DateTimeImmutable($data['updated_at'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->emailVerifiedAt?->format('Y-m-d H:i:s'),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
