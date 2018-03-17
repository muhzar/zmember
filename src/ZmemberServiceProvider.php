<?php

namespace Muhzar\Zmember;

use Illuminate\Support\ServiceProvider;

class ZmemberServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // copy file 
        // $this->publishes([
        //     __DIR__.'/config/calculator.php' => config_path('calculator.php'),
        // ]);
        // target can be config_path, public_path, resource_path

        
        // $this->publishes([
        //     __DIR__.'/configs/zmember.php' => config_path('zmember.php'),
        // ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/configs/zmember.php' => $this->app->config_path('zmember.php'),
            ], 'zmember');
        }


        $this->loadViewsFrom(__DIR__.'/views/', 'zmember');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/configs/services.php', 'services'
        );

        $this->app->make('Muhzar\Zmember\ZmemberController');
    }


    protected function mergeConfig($key, array $baseConfig, array $mergeConfig)
    {
        // merge all the values like normal
        $config = parent::mergeConfig($key, $baseConfig, $mergeConfig);
        
        // merge the individual nested values as needed
        $config['other'] = array_merge($baseConfig['other'], $mergeConfig['other']);
        
        return $config;
    }
}
