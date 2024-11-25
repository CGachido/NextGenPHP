<?php

namespace Architecture\Infraestructure\Repository\Eloquent;

use App\Models\Reservation as EloquentReservation;
use Architecture\Domain\Entities\Reservation;
use Architecture\Domain\Entities\StoredBook;
use Architecture\Domain\Entities\User;

use Architecture\Infraestructure\ReservationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentReservationRepository implements ReservationRepositoryInterface
{
    protected ?Model $model;
    public function __construct()
    {
        $this->model = new EloquentReservation();
    }

    public function save(Reservation $reservation): ?Reservation
    {
        $reservationData = $this->model::updateOrCreate([
            'id' => $reservation->getId()
        ], $reservation->toArray());
        if (!$reservationData) {
            return null;
        }
        $data = $this->extractReservationData($reservationData);
        return Reservation::fromArray($data);
    }

    public function findById(int $reservationId): ?Reservation
    {
        $reservationData = $this->model::find($reservationId);
        if (!$reservationData) {
            return null;
        }
        $data = $this->extractReservationData($reservationData);
        return Reservation::fromArray($data);
    }

    private function extractReservationData($reservationData): array
    {
        return [
            'id' => $reservationData->id,
            'user' => User::fromArray($reservationData->user->toArray()),
            'stored_book' => StoredBook::fromArray($reservationData->storedBook->toArray()),
            'reserved_at' => $reservationData->reserved_at,
            'created_at' => $reservationData->created_at,
            'updated_at' => $reservationData->updated_at,
            'returned_at' => $reservationData->returned_at,
        ];
    }
}
