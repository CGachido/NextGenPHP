<?php

namespace App\Http\Controllers;

use Architecture\Domain\ValueObjects\Id;

use Architecture\Presenter\ResponsePresenterInterface;

use Architecture\UseCases\Reservation\Create\CreateReservationUseCase;
use Architecture\UseCases\Reservation\Create\ReservationInputDTO;
use Architecture\UseCases\Reservation\GetCost\GetReservationCostUseCase;
use Architecture\UseCases\Reservation\GetCost\GetReservationInputCostDTO;
use Architecture\UseCases\Reservation\Return\ReturnReservationInputDTO;
use Architecture\UseCases\Reservation\Return\ReturnReservationUseCase;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function __construct(
        protected CreateReservationUseCase $createReservationUseCase,
        protected ReturnReservationUseCase $returnReservationUseCase,
        protected GetReservationCostUseCase $getReservationCostUseCase,
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

    public function saveReturn(Request $request): JsonResponse
    {
        try {
            $returnReservationDTO = new ReturnReservationInputDTO(
                new Id($request->input('reservation_id')),
                new DateTimeImmutable($request->input('return_date'))
            );
            $reservation = $this->returnReservationUseCase->execute($returnReservationDTO);
            return $this->responsePresenter->success(
                $reservation->toArray(),
                JsonResponse::HTTP_ACCEPTED
            );
        } catch (\Exception $e) {
            return $this->responsePresenter->error($e->getMessage(), $e->getCode());
        } catch (\Error $e) {
            return $this->responsePresenter->internalError();
        }
    }

    public function getCost(Request $request): JsonResponse
    {
        try {
            $getReservationInputCostDTO = new GetReservationInputCostDTO(
                new Id($request->input('reservation_id'))
            );
            $cost = $this->getReservationCostUseCase->execute($getReservationInputCostDTO);
            return $this->responsePresenter->success(
                $cost->toArray(),
                JsonResponse::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->responsePresenter->error($e->getMessage(), $e->getCode());
        } catch (\Error $e) {
            return $this->responsePresenter->internalError();
        }
    }
}
