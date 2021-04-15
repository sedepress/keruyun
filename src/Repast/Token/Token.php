<?php

namespace KeRuYun\Repast\Token;

use Illuminate\Support\Facades\Redis;
use KeRuYun\Kernel\ServiceContainer;

class Token
{
    /**
     * @var \KeRuYun\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * @var string
     */
    protected $cachePrefix = 'lwj_keruyun_token:';

    /**
     * Signature constructor.
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * 获取门店token有缓存取缓存，没缓存请求获取
     *
     * @param int $shopIdenty
     * @return string
     */
    public function getToken(int $shopIdenty): string
    {
        $cacheKey = $this->getCacheKey($shopIdenty);
        $cache = $this->getCache();

        if ($token = $cache->get($cacheKey)) {
            return $token;
        }
        $token = $this->app->base->getToken()['token'];
        $this->setToken($cacheKey, $token);

        return $token;
    }

    /**
     * 设置token
     *
     * @param string $cacheKey
     * @param string $token
     * @return $this
     */
    public function setToken(string $cacheKey, string $token)
    {
        $this->getCache()->set($cacheKey, $token);

        return $this;
    }

    /**
     * 获取缓存提供者
     *
     * @return \Illuminate\Redis\Connections\Connection
     */
    protected function getCache()
    {
        return Redis::connection();
    }

    /**
     * 获取缓存key
     *
     * @param int $shopIdenty
     * @return string
     */
    protected function getCacheKey(int $shopIdenty): string
    {
        return $this->cachePrefix.$shopIdenty;
    }
}