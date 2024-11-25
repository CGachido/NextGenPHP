<?php

namespace Architecture\UseCases\Reservation\Create;

use Architecture\Domain\ValueObjects\Id;

class ReservationInputDTO
{
    public function __construct(
        public Id $userId,
        public Id $storedBookId
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId->getValue(),
            'stored_book_id' => $this->storedBookId->getValue()
        ];
    }
}
