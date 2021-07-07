<?php

namespace Qed\LaravelOnlineUser;

use Illuminate\Support\ServiceProvider;
use Qed\LaravelOnlineUser\Console\Commands\CreateChannel;

class LaravelOnlineUserServiceProvider extends ServiceProvider
{
    /**
     * Register service provider
     *
     * @return void
     */
    public function register()
    {
        //$this->app->register(EventServiceProvider::class);
    }

    /**
     * Boot method
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                __DIR__.'/config/laravel-online-user.php' => config_path('laravel-online-user.php'),
                ]
            );

            $this->commands([
                CreateChannel::class,
            ]);
        }
    }
}
