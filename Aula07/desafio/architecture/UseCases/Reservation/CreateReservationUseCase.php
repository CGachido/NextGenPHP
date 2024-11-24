<?php

namespace Architecture\UseCases\Reservation;

use Architecture\Domain\Entities\Reservation;
use Architecture\Infraestructure\ReservationRepositoryInterface;
use Architecture\Infraestructure\StoredBookRepositoryInterface;
use Architecture\Infraestructure\UserRepositoryInterface;
use DateTimeImmutable;

class CreateReservationUseCase
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected StoredBookRepositoryInterface $storedBookRepository,
        protected ReservationRepositoryInterface $reservationRepository,
    ) {}

    public function execute(ReservationInputDTO $reservationDTO): Reservation
    {
        $user = $this->userRepository->findById($reservationDTO->userId->getValue());
        if (null === $user) {
            throw new \Exception("User Not Found!", 404);
        }

        $storedBook = $this->storedBookRepository->findById($reservationDTO->storedBookId->getValue());
        if (null === $storedBook) {
            throw new \Exception("Stored Book Not Found!", 404);
        }

        $reservationData = Reservation::create(
            user: $user,
            storedBook: $storedBook,
            reservedAt: new DateTimeImmutable()
        );

        return $this->reservationRepository->save($reservationData);
    }
}
