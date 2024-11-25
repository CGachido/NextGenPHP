<?php

namespace Architecture\UseCases\Reservation\GetCost;

use Architecture\Domain\Entities\Reservation;

class GetReservationOutputCostDTO
{
    public function __construct(
        public string $reservationCost,
        public string $costPerDay,
        public int $reservedDays,
        public Reservation $reservation
    ) {}

    public function toArray(): array
    {
        return [
            "reservation_cost" => $this->reservationCost,
            "cost_per_day" => $this->costPerDay,
            "reserved_days" => $this->reservedDays,
            'reservation' => $this->reservation->toArray()
        ];
    }
}
