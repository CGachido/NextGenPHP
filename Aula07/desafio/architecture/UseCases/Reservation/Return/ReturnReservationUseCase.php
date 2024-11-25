<?php

namespace Architecture\UseCases\Reservation\Return;

use Architecture\Domain\Entities\Reservation;
use Architecture\Domain\ValueObjects\Id;
use Architecture\Infraestructure\ReservationRepositoryInterface;
use Architecture\UseCases\Reservation\Find\FindReservationDTO;
use Architecture\UseCases\Reservation\Find\FindReservationUseCase;

class ReturnReservationUseCase
{
    public function __construct(
        protected FindReservationUseCase $findReservation,
        protected ReservationRepositoryInterface $reservationRepository
    ) {}

    public function execute(ReturnReservationInputDTO $returnReservationInputDTO): Reservation
    {
        $reservation = $this->findReservation->execute(new FindReservationDTO(
            $returnReservationInputDTO->reservationId
        ));

        if (null !== $reservation->getReturnedAt()) {
            throw new \Exception("Reservation already returned!", 403);
        }

        $reservation->setReturnedAt($returnReservationInputDTO->returnDate);
        $reservation = $this->reservationRepository->save($reservation);
        if (null === $reservation) {
            throw new \Exception("Reservation could not be returned!", 500);
        }

        return $reservation;
    }
}
