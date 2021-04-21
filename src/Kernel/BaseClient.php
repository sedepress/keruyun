<?php

namespace KeRuYun\Kernel;

use Illuminate\Support\Facades\Http;
use KeRuYun\Kernel\Exceptions\HttpException;
use KeRuYun\Kernel\Exceptions\InvalidArgumentException;
use KeRuYun\Kernel\Exceptions\KeRuYunException;

class BaseClient
{
    /**
     * @var \KeRuYun\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * BaseClient constructor.
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * request请求
     *
     * @param string $method
     * @param string $uri
     * @param array|null $data
     * @param array $options
     * @return mixed
     * @throws HttpException
     */
    protected function request(string $method, string $uri, array $data = [], array $options = [])
    {
        $url = $this->getRequestUrl($uri, time() * 1000, $options['isToken'] ?? false);

        logger()->debug('请求客如云API', ['url' => $url, 'data' => $data]);
        try {
            switch (strtolower($method))
            {
                case 'get':
                    $response = Http::withHeaders(['Content-Type' => 'application/json'])->retry(3, 500)->get($url)->body();
                    break;
                case 'post':
                    $response = Http::withHeaders(['Content-Type' => 'application/json'])->retry(3, 500)->post($url, $data)->body();
                    break;
                default:
                    throw new InvalidArgumentException('未授权的请求方式');
            }
            $result = json_decode($response, true);

            if ($result['code'] != 0) {
                logger()->error('客如云接口请求失败', ['url' => $url, 'result' => $result]);
                throw new KeRuYunException($result['message']);
            }

            return $result['result'];
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 生成请求url
     *
     * @param string $uri
     * @param int $timestamp
     * @param bool $isToken
     * @return string
     */
    protected function getRequestUrl(string $uri, int $timestamp, bool $isToken = false): string
    {
        $query = [
            'appKey' => $this->app->config['appKey'],
            'shopIdenty' => $this->app->config['shopIdenty'],
            'version' => $this->app->config['version'],
            'timestamp' => $timestamp,
            'sign' => $this->app->signature->signature($timestamp, $isToken)
        ];

        return $this->app->config['baseUri'] . $uri . '?' . http_build_query($query);
    }
}
