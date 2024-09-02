<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRoutePriceRequest;
use Illuminate\Http\JsonResponse;

class TransportController extends Controller
{
    public function calculateRoutePrice(CalculateRoutePriceRequest $request): JsonResponse
    {
        return response()->json();
    }
}
