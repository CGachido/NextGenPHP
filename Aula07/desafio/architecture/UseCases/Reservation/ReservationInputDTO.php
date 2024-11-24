<?php

namespace Architecture\UseCases\Reservation;

use Architecture\Domain\ValueObjects\StoredBookId;
use Architecture\Domain\ValueObjects\UserId;

class ReservationInputDTO
{
    public function __construct(
        public UserId $userId,
        public StoredBookId $storedBookId
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId->getValue(),
            'stored_book_id' => $this->storedBookId->getValue()
        ];
    }
}
