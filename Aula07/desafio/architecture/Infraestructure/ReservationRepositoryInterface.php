<?php

namespace Architecture\Infraestructure;

use Architecture\Domain\Entities\Reservation;

interface ReservationRepositoryInterface
{
    /**     
     * @return Reservation
     */
    public function save(Reservation $reservation): ?Reservation;

    /**     
     * @return Reservation
     */
    public function findById(int $reservationId): ?Reservation;
}
