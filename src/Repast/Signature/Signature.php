<?php

namespace KeRuYun\Repast\Signature;

use KeRuYun\Kernel\ServiceContainer;

class Signature
{
    /**
     * @var \KeRuYun\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * Signature constructor.
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * 生成签名
     *
     * @param int $timestamp
     * @param bool $isToken
     * @return string
     */
    public function signature(int $timestamp, bool $isToken = false): string
    {
        $str = [
            'appKey',
            $this->app['config']['appKey'],
            'shopIdenty',
            $this->app['config']['shopIdenty'],
            'timestamp',
            $timestamp,
            'version',
            $this->app['config']['version'],
            $isToken ? $this->app['config']['secretKey'] : $this->app->token->getToken($this->app['config']['shopIdenty'])
        ];

        return $this->sha256($str);
    }

    /**
     * 验证签名
     *
     * @param string $appKey
     * @param int $shopIdenty
     * @param int $timestamp
     * @param string $version
     * @param string $signature
     * @return bool
     */
    public function verifySign(string $appKey, int $shopIdenty, int $timestamp, string $version, string $signature): bool
    {
        $str = [
            'appKey',
            $appKey,
            'shopIdenty',
            $shopIdenty,
            'timestamp',
            $timestamp,
            'version',
            $version,
            $this->app->token->getToken($this->app['config']['shopIdenty'])
        ];

        return $signature === $this->sha256($str);
    }

    /**
     * sha256加密
     *
     * @param $str
     * @return string
     */
    protected function sha256($str): string
    {
        if (is_array($str)) {
            $str = implode($str);
        }

        return hash('sha256', $str);
    }
}