<?php

namespace KeRuYun\Repast\Dinner;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['dinner'] = function ($app) {
            return new Client($app);
        };
    }
}
