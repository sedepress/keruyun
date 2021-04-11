<?php

namespace KeRuYun\Repast\Pay;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['pay'] = function ($app) {
            return new Client($app);
        };
    }
}
