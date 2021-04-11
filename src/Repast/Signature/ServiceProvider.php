<?php

namespace KeRuYun\Repast\Signature;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        !isset($app['signature']) && $app['signature'] = function ($app) {
            return new Signature($app);
        };
    }
}
