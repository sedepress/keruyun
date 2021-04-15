<?php

namespace KeRuYun\Repast\Base;

use KeRuYun\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取门店token
     *
     * @return mixed|null
     * @throws \KeRuYun\Kernel\Exceptions\HttpException
     */
    public function getToken()
    {
        return $this->request('get', '/open/v1/token/get', [], ['isToken' => true]);
    }
}