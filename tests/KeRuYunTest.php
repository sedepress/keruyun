<?php

namespace KeRuYun\Tests;

use KeRuYun\Factory;
use Tests\TestCase;

class KeRuYunTest extends TestCase
{
    public function testOrder()
    {
        $app = Factory::repast([
            'appKey' => '123213123123',
            'token' => '123123123',
            'timestamp' => 123123123,
            'version' => '1.0',
            'shopIdenty' => 80123123123
        ]);

        var_dump($app->signature->signature(time() * 1000));
    }
}