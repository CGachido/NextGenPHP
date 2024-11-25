<?php

namespace Architecture\UseCases\Reservation\Find;

use Architecture\Domain\ValueObjects\Id;

class FindReservationDTO
{
    public function __construct(
        public Id $reservationId
    ) {}

    public function toArray(): array
    {
        return [
            'reservation_id' => $this->reservationId->getValue()
        ];
    }
}
