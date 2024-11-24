<?php

namespace Architecture\Infraestructure;

use Architecture\Domain\Entities\Reservation;

interface ReservationRepositoryInterface
{
    public function save(Reservation $reservation): Reservation;
}
