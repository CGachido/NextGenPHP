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

    public function save(Reservation $reservation): Reservation
    {
        $reservationData = $this->model->fill($reservation->toArray());
        $reservationData->save();
        return Reservation::fromArray([
            'id' => $reservationData->id,
            'user' => User::fromArray($reservationData->user->toArray()),
            'stored_book' => StoredBook::fromArray($reservationData->storedBook->toArray()),
            'reserved_at' => $reservationData->reservedAt,
            'created_at' => $reservationData->createdAt,
            'updated_at' => $reservationData->updatedAt,
        ]);
    }
}
