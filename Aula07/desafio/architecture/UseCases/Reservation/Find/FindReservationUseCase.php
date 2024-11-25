<?php

namespace Architecture\UseCases\Reservation\Find;

use Architecture\Domain\Entities\Reservation;
use Architecture\Infraestructure\ReservationRepositoryInterface;


class FindReservationUseCase
{
    public function __construct(
        protected ReservationRepositoryInterface $reservationRepository
    ) {}

    public function execute(FindReservationDTO $findReservationDTO): Reservation
    {
        $reservation = $this->reservationRepository->findById(
            $findReservationDTO->reservationId->getValue()
        );

        if (null === $reservation) {
            throw new \Exception("Reservation Not Found!", 404);
        }

        return $reservation;
    }
}
