<?php

namespace App\Services;

use App\Interfaces\GoogleDirectionServiceInterface;
use App\Interfaces\TransportServiceInterface;
use App\Models\VehicleType;

class TransportService implements TransportServiceInterface
{
    public function __construct(
        private readonly GoogleDirectionServiceInterface $googleDirectionService,
        private array $response = [],
        private int $totalDistance = 0
    ) {
    }

    public function getResponse(array $payload): array
    {
        $totalDistance = $this->getTotalDistance($payload);
        $vehicleTypes = VehicleType::all();

        foreach ($vehicleTypes as $vehicleType) {
            $price = round($vehicleType->cost_km * $totalDistance);

            $this->response[] = [
                'vehicle_type' => $vehicleType->number,
                'price' => $price < $vehicleType->minimum ? $vehicleType->minimum : $price,
            ];
        }

        return $this->response;
    }

    private function getTotalDistance(array $payload): float
    {
        $addresses = $payload['addresses'];

        for ($i = 0; $i < count($addresses) - 1; $i++) {
            $distance = $this->googleDirectionService->getDistance(
                $addresses[$i]['city'],
                $addresses[$i + 1]['city']
            );

            $this->totalDistance += $distance;
        }

        return $this->totalDistance / 1000;
    }
}
