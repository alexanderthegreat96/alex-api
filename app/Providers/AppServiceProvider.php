<?php

namespace App\Providers;

use App\Helpers\Exchange;
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
        $this->app->bind(Exchange::class,function(){
            return new Exchange();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */


    public function boot()
    {
        //
    }
}
