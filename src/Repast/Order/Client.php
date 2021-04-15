<?php

namespace KeRuYun\Repast\Order;

use KeRuYun\Kernel\BaseClient;
use KeRuYun\Kernel\Dict;

class Client extends BaseClient
{
    /**
     * 查询订单列表
     *
     * @param int $shopIdenty 客如云门店ID
     * @param int $startTime 开始时间，timeType=1此字段代表营业日;timeType=2代表订单支付时间；注：时间单位为毫秒，只支持最近7天数据查询
     * @param int $endTime 结束时间；timeType=1此字段代表营业日；timeType=2代表订单支付时间；注：时间单位为毫秒，只支持最近7天数据查询
     * @param int $pageNo 页码；从1开始；不传默认为1
     * @param int $pageSize 每页条数；取值范围10~100,不传默认100
     * @param int $timeType 时间类型；默认下单时间；1-下单时间；2-支付时间；推荐使用支付时间(返回值当中的checkOutTime)作为分页参数，这样会降低查询靠近当前时间的订单的丢单几率
     * @return mixed
     * @throws \KeRuYun\Kernel\Exceptions\HttpException
     */
    public function getOrderIdList(int $shopIdenty, int $startTime, int $endTime, int $pageNo = 1, int $pageSize = 100, int $timeType = Dict::TIME_TYPE_PAY)
    {
        $body = [
            'shopIdenty' => $shopIdenty,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'timeType' => $timeType,
            'pageNo' => $pageNo,
            'pageSize' => $pageSize
        ];

        return $this->request('post', '/open/v1/data/order/export2', $body);
    }

    /**
     * 查询订单详情
     *
     * @param array $ids 客如云订单号（tradeId，可通过订单列表获取，也可通过下单接口返回的参数中获取）,最多20条
     * @param int $shopIdenty 客如云门店
     * @return mixed|null
     * @throws \KeRuYun\Kernel\Exceptions\HttpException
     */
    public function getOrderDetailList(array $ids, int $shopIdenty)
    {
        $body = [
            'ids' => $ids,
            'shopIdenty' => $shopIdenty
        ];

        return $this->request('post', '/open/v1/data/order/exportDetail', $body);
    }
}
