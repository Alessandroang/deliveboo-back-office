<?php

namespace App\Providers;
use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'v9v2hw246r5n6kx9',
                'publicKey' => 'sy8jpy7qbgrh2csk',
                'privateKey' => 'e43fadabae2512b82c0f99164fbc9b55',
            ]);
        });
    }
}
