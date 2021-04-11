<?php

namespace KeRuYun\Repast\Dish;

use KeRuYun\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 菜品分页查询
     *
     * @param int $shopIdenty 客如云门店ID
     * @param int $pageNum 开始记录ID(默认1),下一页需带上返回参数中startId的值，返回参数中startId为null表示无下一页
     * @param int $startId 每页最大记录数(默认1000)
     * @return mixed|null
     */
    public function dishMenu(int $shopIdenty, int $pageNum = 1000, int $startId = 1)
    {
        $body = [
            'shopIdenty' => $shopIdenty,
            'startId' => $startId,
            'pageNum' => $pageNum
        ];

        return $this->request('post', '/open/v1/cater/dish/dishMenu', $body);
    }
}