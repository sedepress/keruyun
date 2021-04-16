<?php

namespace KeRuYun\Repast;

use KeRuYun\Kernel\ServiceContainer;

/**
 * Class Application.
 * @property \KeRuYun\Repast\Token\Token            $token
 * @property \KeRuYun\Repast\Base\Client            $base
 * @property \KeRuYun\Repast\Dinner\Client          $dinner
 * @property \KeRuYun\Repast\Dish\Client            $dish
 * @property \KeRuYun\Repast\Order\Client           $order
 * @property \KeRuYun\Repast\Pay\Client             $pay
 * @property \KeRuYun\Repast\Signature\Signature    $signature
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Token\ServiceProvider::class,
        Base\ServiceProvider::class,
        Dinner\ServiceProvider::class,
        Dish\ServiceProvider::class,
        Order\ServiceProvider::class,
        Pay\ServiceProvider::class,
        Signature\ServiceProvider::class,
    ];
}
