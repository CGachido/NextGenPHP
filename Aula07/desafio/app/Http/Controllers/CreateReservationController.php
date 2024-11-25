<?php

namespace App\Http\Controllers;

use Architecture\Domain\ValueObjects\Id;
use Architecture\Presenter\ResponsePresenterInterface;
use Architecture\UseCases\Reservation\Create\CreateReservationUseCase;
use Architecture\UseCases\Reservation\Create\ReservationInputDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateReservationController extends Controller
{
    public function __construct(
        protected CreateReservationUseCase $createReservationUseCase,
        protected ResponsePresenterInterface $responsePresenter
    ) {}

    public function create(Request $request): JsonResponse
    {
        try {
            $reservationDTO = new ReservationInputDTO(
                new Id($request->input('user_id')),
                new Id($request->input('stored_book_id')),
            );
            $reservation = $this->createReservationUseCase->execute($reservationDTO);
            return $this->responsePresenter->success($reservation->toArray(), JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return  $this->responsePresenter->error($e->getMessage(), $e->getCode());
        } catch (\Error $e) {
            return  $this->responsePresenter->internalError();
        }
    }
}
