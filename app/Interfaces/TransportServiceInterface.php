<?php

namespace App\Interfaces;

interface TransportServiceInterface
{
    public function getResponse(array $payload): array;
}
