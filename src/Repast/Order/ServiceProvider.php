<?php

namespace KeRuYun\Repast\Order;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['order'] = function ($app) {
            return new Client($app);
        };
    }
}
