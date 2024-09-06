<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRoutePriceRequest;
use App\Interfaces\TransportServiceInterface;
use Illuminate\Http\JsonResponse;

class TransportController extends Controller
{
    public function __construct(
        private readonly TransportServiceInterface $transportService
    ) {
    }

    public function __invoke(CalculateRoutePriceRequest $request): JsonResponse
    {
        $response = $this->transportService->getResponse($request->validated());

        return response()->json($response);
    }
}
