<?php

/*
 * This file is part of Laravel Mailjet.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Mailjet;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class MailjetServiceProvider extends ServiceProvider
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
}
