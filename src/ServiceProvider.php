<?php

namespace CCUPLUS\Authentication;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('authentication', function () {
            return new Authentication;
        });
    }
}
