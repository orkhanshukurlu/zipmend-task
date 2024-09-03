<?php

namespace Tests\Feature;

use App\Services\GoogleDirectionService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GoogleDirectionAPITest extends TestCase
{
    public function test_send_request_to_google_direction_api(): void
    {
        Http::fake([
            'maps.googleapis.com/maps/api/directions/json*' => Http::response([
                'routes' => [
                    [
                        'legs' => [
                            [
                                'distance' => [
                                    'text' => '1 km',
                                    'value' => 1000,
                                ],
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $service = new GoogleDirectionService();
        $distance = $service->getDistance('Place A', 'Place B');

        $this->assertIsInt($distance);
    }
}
