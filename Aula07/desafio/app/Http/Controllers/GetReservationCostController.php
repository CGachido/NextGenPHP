<?php

namespace App\Http\Controllers;

use Architecture\Domain\ValueObjects\Id;
use Architecture\Presenter\ResponsePresenterInterface;
use Architecture\UseCases\Reservation\Create\CreateReservationUseCase;
use Architecture\UseCases\Reservation\GetCost\GetReservationInputCostDTO;
use Architecture\UseCases\Reservation\GetCost\GetReservationCostUseCase;
use Architecture\UseCases\Reservation\Return\ReturnReservationUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetReservationCostController extends Controller
{
    public function __construct(
        protected CreateReservationUseCase $createReservationUseCase,
        protected ReturnReservationUseCase $returnReservationUseCase,
        protected GetReservationCostUseCase $getReservationCostUseCase,
        protected ResponsePresenterInterface $responsePresenter
    ) {}

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
