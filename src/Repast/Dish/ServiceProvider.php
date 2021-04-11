<?php

namespace KeRuYun\Repast\Dish;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['dish'] = function ($app) {
            return new Client($app);
        };
    }
}
