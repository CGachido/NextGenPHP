<?php

namespace App\Http\Controllers;

use Architecture\Domain\ValueObjects\Id;
use Architecture\Presenter\ResponsePresenterInterface;
use Architecture\UseCases\Reservation\Return\ReturnReservationInputDTO;
use Architecture\UseCases\Reservation\Return\ReturnReservationUseCase;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReturnReservationController extends Controller
{
    public function __construct(
        protected ReturnReservationUseCase $returnReservationUseCase,
        protected ResponsePresenterInterface $responsePresenter
    ) {}

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
}
