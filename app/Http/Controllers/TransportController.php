<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRoutePriceRequest;
use App\Services\TransportService;
use Illuminate\Http\JsonResponse;

class TransportController extends Controller
{
    public function __construct(
        private readonly TransportService $transportService
    ) {
    }

    public function __invoke(CalculateRoutePriceRequest $request): JsonResponse
    {
        $response = $this->transportService->getResponse($request->validated());

        return response()->json($response);
    }
}
