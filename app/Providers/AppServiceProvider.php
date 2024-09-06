<?php

namespace App\Providers;

use App\Interfaces\GoogleDirectionServiceInterface;
use App\Interfaces\TransportServiceInterface;
use App\Services\GoogleDirectionService;
use App\Services\TransportService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GoogleDirectionServiceInterface::class, GoogleDirectionService::class);
        $this->app->bind(TransportServiceInterface::class, TransportService::class);
    }

    public function boot(): void
    {
        //
    }
}
