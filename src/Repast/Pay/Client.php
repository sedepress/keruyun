<?php

namespace KeRuYun\Repast\Pay;

use KeRuYun\Kernel\BaseClient;
use KeRuYun\Kernel\Dict;

class Client extends BaseClient
{
    /**
     * 扫码支付（主扫）
     *
     * @param string $outTradeNo 支付单号
     * @param int $payFee 支付金额(单位：分)
     * @param string $payOrg 支付机构代码：详见支付机构代码
     * @param string $productDesc 订单商品描述
     * @return mixed|null
     */
    public function scanCode(string $outTradeNo, int $payFee, string $payOrg = Dict::ORG_ALIPAY, string $productDesc = '商品描述')
    {
        $body = [
            'outTradeNo' => $outTradeNo,
            'payOrg' => $payOrg,
            'productDesc' => $productDesc,
            'payFee' => $payFee
        ];

        return $this->request('post', 'open/v1/wallet/scanCode', $body);
    }

    /**
     * 扫码支付（被扫）
     *
     * @param string $authCode 用户展示的付款码
     * @param string $outTradeNo 支付单号
     * @param int $payFee 支付金额(单位：分)
     * @param string $payOrg 支付机构代码：详见支付机构代码
     * @param string $productDesc 订单商品描述
     * @return mixed|null
     */
    public function showCode(string $authCode, string $outTradeNo, int $payFee, string $payOrg = Dict::ORG_ALIPAY, string $productDesc = '商品描述')
    {
        $body = [
            'authCode' => $authCode,
            'outTradeNo' => $outTradeNo,
            'payFee' => $payFee,
            'payOrg' => $payOrg,
            'productDesc' => $productDesc
        ];

        return $this->request('post', 'open/v1/wallet/showCode', $body);
    }

    /**
     * 支付状态查询
     *
     * @param string $outTradeNo 支付单号
     * @return mixed|null
     */
    public function payQuery(string $outTradeNo)
    {
        $body = [
            'outTradeNo' => $outTradeNo
        ];

        return $this->request('post', 'open/v1/wallet/payQuery', $body);
    }

    /**
     * 退款申请
     *
     * @param int $refundFee 退款金额
     * @param string $outRefundNo 调用方退款单号
     * @param string $outTradeNo 支付单号
     * @return mixed|null
     */
    public function refundApply(int $refundFee, string $outRefundNo, string $outTradeNo)
    {
        $body = [
            'refundFee' => $refundFee,
            'outRefundNo' => $outRefundNo,
            'outTradeNo' => $outTradeNo
        ];

        return $this->request('post', 'open/v1/wallet/refundApply', $body);
    }

    /**
     * 退款状态查询
     *
     * @param string $outRefundNo 调用方退款单号
     * @param string $outTradeNo 支付单号
     * @return mixed|null
     */
    public function refundQuery(string $outRefundNo, string $outTradeNo)
    {
        $body = [
            'outRefundNo' => $outRefundNo,
            'outTradeNo' => $outTradeNo,
        ];

        return $this->request('post', 'open/v1/wallet/refundQuery', $body);
    }
}