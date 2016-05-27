<?php

namespace DraperStudio\Mailjet;

use Illuminate\Support\Arr;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        app('swift.transport')->extend('mailjet', function () {
            $config = $this->app['config']->get('services.mailjet', []);

            return new MailjetTransport(
                new HttpClient(Arr::get($config, 'guzzle', [])),
                $config['public'], $config['private']
            );
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
