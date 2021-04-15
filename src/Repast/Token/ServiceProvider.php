<?php

namespace KeRuYun\Repast\Token;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        !isset($app['token']) && $app['token'] = function ($app) {
            return new Token($app);
        };
    }
}
