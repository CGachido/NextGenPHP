<?php

namespace Architecture\UseCases\Reservation\GetCost;

use Architecture\Domain\Entities\Reservation;
use Architecture\Infraestructure\ReservationRepositoryInterface;
use Architecture\UseCases\Reservation\Find\FindReservationUseCase;
use Architecture\UseCases\Reservation\Find\FindReservationDTO;

class GetReservationCostUseCase
{
    const COST_PER_DAY = 4.50;

    public function __construct(
        protected FindReservationUseCase $findReservation,
        protected ReservationRepositoryInterface $reservationRepository
    ) {}

    public function execute(
        GetReservationInputCostDTO $getReservationCostDTO
    ): GetReservationOutputCostDTO {
        $reservation = $this->findReservation->execute(new FindReservationDTO(
            $getReservationCostDTO->reservationId
        ));

        if (null === $reservation->getReturnedAt()) {
            throw new \Exception("To calculate the cost, the reservation must be closed!", 403);
        }

        $reservedDays = $this->getDiffInDays($reservation);
        $reservationCost = $this->calculateCost($reservedDays);

        return new GetReservationOutputCostDTO(
            reservationCost: 'R$ ' . $reservationCost,
            costPerDay: 'R$ ' . number_format(self::COST_PER_DAY, 2, ',', '.'),
            reservedDays: $reservedDays,
            reservation: $reservation
        );
    }

    private function calculateCost(int $reservedDays): string
    {
        if ($reservedDays > 1) {
            return number_format($reservedDays * self::COST_PER_DAY, 2, ',', '.');
        }
        return number_format(self::COST_PER_DAY, 2, ',', '.');
    }

    private function getDiffInDays(Reservation $reservation): int
    {
        $reservedAt = new \DateTimeImmutable($reservation->getReservedAt());
        $returnedAt = new \DateTimeImmutable($reservation->getReturnedAt());
        return $returnedAt->diff($reservedAt)->days;
    }
}
