<?php

namespace Tests\Unit;

use Tests\TestCase;

class TransportControllerTest extends TestCase
{
    public function test_get_calculated_route_prices_returns_correct_response(): void
    {
        $response = $this->withBasicAuth('username', 'password')->post('/api/calculate', [
            'addresses' => [
                ['country' => 'DE', 'zip' => '10115', 'city' => 'Berlin'],
                ['country' => 'DE', 'zip' => '20095', 'city' => 'Hamburg'],
            ],
        ]);

        $response->assertOk();
    }
}
