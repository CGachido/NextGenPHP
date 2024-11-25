<?php

namespace Architecture\UseCases\Reservation\Return;

use Architecture\Domain\ValueObjects\Id;
use DateTimeImmutable;

class ReturnReservationInputDTO
{
    public function __construct(
        public Id $reservationId,
        public DateTimeImmutable $returnDate
    ) {}

    public function toArray(): array
    {
        return [
            'reservation_id' => $this->reservationId->getValue()
        ];
    }
}
