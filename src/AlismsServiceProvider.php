<?php

namespace Faed\Alisms;


use Illuminate\Support\ServiceProvider;
class AlismsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            $this->configPath() => config_path('sms.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'sms');
    }



    /**
     * Set the config path
     *
     * @return string
     */
    protected function configPath()
    {
        return __DIR__ . '/config/sms.php';
    }
}
