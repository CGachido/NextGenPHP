<?php

namespace Architecture\Domain\Entities;

use DateTimeImmutable;

class Book
{
    public function __construct(
        protected int $id,
        protected string $title,
        protected string $author,
        protected DateTimeImmutable $createdAt,
        protected DateTimeImmutable $updatedAt
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['author'],
            new DateTimeImmutable($data['created_at']),
            new DateTimeImmutable($data['updated_at'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }
}
