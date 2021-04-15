<?php

namespace KeRuYun\Repast\Dinner;

use KeRuYun\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 正餐下单
     * tpOrderId这个字段客如云会检验唯一性，相同返回同一客如云订单号
     * exp：{
     * "createTime": 1567477463000,
     * "customers": [
     * {
     * "gender": 0,
     * "id": 37950727842270123,
     * "name": "张三",
     * "phoneNumber": 13239373760
     * }
     * ],
     * "discountAmount": 0,
     * "discountDetails": [
     * {
     * "couponId": 80977362259301376,
     * "customerId": 1573,
     * "description": "我是优惠券描述",
     * "discountFee": 0,
     * "discountType": 3
     * }
     * ],
     * "peopleCount": 1,
     * "print": 1,
     * "productCategorySize": 1,
     * "products": [
     * {
     * "id": 248921597135188992,
     * "name": "大波浪薯片2",
     * "price": 1,
     * "quantity": 1,
     * "remark": "菜品备注哈哈",
     * "totalFee": 1,
     * "tpId": "23245",
     * "unit": "份"
     * }
     * ],
     * "remark": "备注信息",
     * "shopIdenty": 810094162,
     * "shopName": "体验区测试品牌01体验区测试品牌01store品牌1门店3",
     * "status": 2,
     * "tables": [
     * {
     * "remark": "我是桌台备注",
     * "tableId": 114430334904879104,
     * "tableName": "桌台009"
     * }
     * ],
     * "totalPrice": 1,
     * "tpOrderId": "1234512345678902331234",
     * "userFee": 1
     * }
     *
     * @param array $params
     * @return mixed|null
     * @throws \KeRuYun\Kernel\Exceptions\HttpException
     */
    public function create(array $params)
    {
        return $this->request('post', '/open/v1/dinner/order/create', $params);
    }

    /**
     * 支付订单
     *
     * @param string $id 客如云返回给第三方的开放平台订单ID
     * @param int $totalFee 订单总额 单位：分
     * @param int $userFee 顾客实付 顾客实付＝订单总额－优惠总额单位：分
     * @param array $paymentDetail 支付明细
     * @param int $isPrint 是否打印结账单 0:不打印(默认)，1:打印
     * @return mixed|null
     * @throws \KeRuYun\Kernel\Exceptions\HttpException
     */
    public function pay(string $id, int $totalFee, int $userFee, array $paymentDetail, int $isPrint = 0)
    {
        $body = [
            'id' => $id,
            'totalFee' => $totalFee,
            'userFee' => $userFee,
            'isPrint' => $isPrint,
            'paymentDetail' => $paymentDetail
        ];

        return $this->request('post', '/open/v1/dinner/order/pay', $body);
    }
}