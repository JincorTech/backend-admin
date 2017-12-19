<?php

namespace App\Providers;

use App\Extensions\AccessTokenGuard;
use Illuminate\Support\ServiceProvider;
use JincorTech\AuthClient\AuthServiceInterface;

class ExternalAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('auth')->extend('externalAuth', function ($app, $name, array $config) {
            return new AccessTokenGuard(
                $app->make('request'),
                $app->make(AuthServiceInterface::class)
            );
        });
    }
}