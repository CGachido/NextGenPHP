<?php

namespace Architecture\UseCases\Reservation\GetCost;

use Architecture\Domain\ValueObjects\Id;

class GetReservationInputCostDTO
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
