<?php

namespace App\Interfaces;

interface GoogleDirectionServiceInterface
{
    public function getDistance(string $origin, string $destination): int;
}
