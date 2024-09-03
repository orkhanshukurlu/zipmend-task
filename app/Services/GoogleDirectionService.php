<?php

namespace App\Services;

use App\Exceptions\GoogleDirectionAPIException;
use Illuminate\Support\Facades\Http;

class GoogleDirectionService
{
    public function getDistance(string $origin, string $destination): int
    {
        $response = $this->getResponse($origin, $destination);

        if (isset($response['error_message'])) {
            throw new GoogleDirectionAPIException($response['error_message']);
        }

        if (empty($distance = $response['routes'][0]['legs'][0]['distance']['value'])) {
            throw new GoogleDirectionAPIException('Distance value is missing in api response');
        }

        return $distance;
    }

    private function getOrigin(string $origin): string
    {
        return str_replace(' ', '+', $origin);
    }

    private function getDestination(string $destination): string
    {
        return str_replace(' ', '+', $destination);
    }

    private function getKey(): string
    {
        return config('google.api_key');
    }

    private function getResponse(string $origin, string $destination): array
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
            'origin' => $this->getOrigin($origin),
            'destination' => $this->getDestination($destination),
            'key' => $this->getKey(),
        ]);

        return $response->json();
    }
}
