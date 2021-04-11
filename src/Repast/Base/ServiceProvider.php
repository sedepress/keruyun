<?php

namespace KeRuYun\Repast\Base;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['base'] = function ($app) {
            return new Client($app);
        };
    }
}
