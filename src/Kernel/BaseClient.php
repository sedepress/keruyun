<?php

namespace KeRuYun\Kernel;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use KeRuYun\Exceptions\HttpException;

class BaseClient
{
    protected $app;

    protected $signature;

    protected $baseUri;

    protected $guzzleOptions = [];

    /**
     * BaseClient constructor.
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    public function getHttpClient(): Client
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function httpGet(string $url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    public function httpPost(string $url, array $data = [])
    {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }

    public function httpPostJson(string $url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }

    protected function request(string $method, string $uri, array $body = null)
    {
        try {
            switch (strtolower($method))
            {
                case 'get':
                    $response = $this->getHttpClient()->get($this->getUrl($uri))->getBody()->getContents();
                    break;
                case 'post':
                    $response = $this->getHttpClient()->post($this->getUrl($uri), $body)->getBody()->getContents();
                    break;
                default:
                    return null;
            }

            return json_decode($response, true);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    protected function getUrl(string $uri): string
    {
//        if (config('app.env') === 'production') {
//            $baseUri = config('keruyun.production');
//        } else {
//            $baseUri = config('keruyun.sanbox');
//        }
        $baseUri = 'https://gldopenapi.keruyun.com';

        $timestamp = time();
//        $shopIdenty = config('keruyun.shopIdenty');
        $shopIdenty = 810094162;
//        $version = config('keruyun.version');
        $version = '1.0';

        $query = [
//            'appKey' => config('keruyun.appKey'),
            'appKey' => 'aa57c6eb4431890ef1132753fe40bf1a',
            'shopIdenty' => $shopIdenty,
            'version' => $version,
            'timestamp' => $timestamp,
            'sign' => $this->signature($shopIdenty, $version, $timestamp)
        ];

        return $baseUri . $uri . '?' . http_build_query($query);
    }

    protected function signature(int $shopIdenty, string $version, string $timestamp): string
    {
        $str = [
            'appKey',
//            config('keruyun.appKey'),
            'aa57c6eb4431890ef1132753fe40bf1a',
            'shopIdenty',
            $shopIdenty,
            'timestamp',
            $timestamp,
            'version',
            $version,
//            config('keruyun.token')
            '4c1d52f65deda67e428c378b8e61c91a'
        ];

        return $this->sha256($str);
    }

    protected function sha256($str): string
    {
        if (is_array($str)) {
            $str = implode($str);
        }

        return hash('sha256', $str);
    }

    public function verifySign(array $params): bool
    {
        $str = [
            'appKey',
            $params['appKey'],
            'shopIdenty',
            $params['shopIdenty'],
            'timestamp',
            $params['timestamp'],
            'version',
            $params['version'],
            config('keruyun.token')
        ];

        $sign = $this->sha256($str);

        if ($params['sign'] === $sign) {
            return true;
        }

        return false;
    }
}
