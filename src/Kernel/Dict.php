<?php

namespace KeRuYun\Kernel;

/*
 * 客如云数据字典
 */
class Dict
{
    const ORDER_PUSH_CREATE = 1;
    const ORDER_PUSH_CONFIRM = 13;
    const ORDER_PUSH_REFUSE = 14;
    const ORDER_PUSH_CANCEL = 15;
    const ORDER_PUSH_VOID = 16;
    const ORDER_PUSH_RETURN = 19;
    const ORDER_PUSH_REFUND = 20;
    const ORDER_PUSH_CHECKOUT = 21;
    const ORDER_PUSH_COMPLETE = 26;
    const ORDER_PUSH_COMBINE = 91;
    const ORDER_PUSH_ACCOUNT = 92;
    const ORDER_PUSH_PAYED = 93;

    public static $orderPushMap = [
        self::ORDER_PUSH_CREATE => '订单创建',
        self::ORDER_PUSH_CONFIRM => '订单确认（接受订单)',
        self::ORDER_PUSH_REFUSE => '拒绝订单',
        self::ORDER_PUSH_CANCEL => '订单取消',
        self::ORDER_PUSH_VOID => '订单作废',
        self::ORDER_PUSH_RETURN => '退货',
        self::ORDER_PUSH_REFUND => '退款',
        self::ORDER_PUSH_CHECKOUT => '反结账',
        self::ORDER_PUSH_COMPLETE => '订单完成',
        self::ORDER_PUSH_COMBINE => '合单',
        self::ORDER_PUSH_ACCOUNT => '挂账',
        self::ORDER_PUSH_PAYED => '支付完成'
    ];

    const TRADE_TYPE_SELL = 1;
    const TRADE_TYPE_REFUND = 2;
    const TRADE_TYPE_SPLIT = 3;
    const TRADE_TYPE_CHECKOUT = 4;
    const TRADE_TYPE_CHECKOUT_REFUND = 5;

    public static $tradeTypeMap = [
        self::TRADE_TYPE_SELL => '售货',
        self::TRADE_TYPE_REFUND => '退货',
        self::TRADE_TYPE_SPLIT => '拆单',
        self::TRADE_TYPE_CHECKOUT => '反结账(已收款退货时新生成的订单)',
        self::TRADE_TYPE_CHECKOUT_REFUND => '反结账退货(已收款退货时新生成的反向订单,金额是销货单的负数)'
    ];

    const TRADE_PAY_STATUS_UN_PAID = 1;
    const TRADE_PAY_STATUS_PAYING = 2;
    const TRADE_PAY_STATUS_PAID = 3;
    const TRADE_PAY_STATUS_REFUNDING = 4;
    const TRADE_PAY_STATUS_REFUNDED = 5;
    const TRADE_PAY_STATUS_REFUND_FAILED = 6;
    const TRADE_PAY_STATUS_PREPAID = 7;
    const TRADE_PAY_STATUS_WAITING_REFUND = 8;
    const TRADE_PAY_STATUS_PAY_FAILED = 9;

    public static $tradePayStatusMap = [
        self::TRADE_PAY_STATUS_UN_PAID => '未支付',
        self::TRADE_PAY_STATUS_PAYING => '支付中',
        self::TRADE_PAY_STATUS_PAID => '已支付',
        self::TRADE_PAY_STATUS_REFUNDING => '退款中',
        self::TRADE_PAY_STATUS_REFUNDED => '已退款',
        self::TRADE_PAY_STATUS_REFUND_FAILED => '退款失败',
        self::TRADE_PAY_STATUS_PREPAID => '预支付',
        self::TRADE_PAY_STATUS_WAITING_REFUND => '等待退款',
        self::TRADE_PAY_STATUS_PAY_FAILED => '支付失败'
    ];

    const TRADE_STATUS_UNTREATED = 1;
    const TRADE_STATUS_PENDING = 2;
    const TRADE_STATUS_CONFIRM = 3;
    const TRADE_STATUS_COMPLETE = 4;
    const TRADE_STATUS_RETURN = 5;
    const TRADE_STATUS_VOID = 6;
    const TRADE_STATUS_REFUSE = 7;
    const TRADE_STATUS_CANCEL = 8;
    const TRADE_STATUS_CHECKOUT = 10;

    public static $tradeStatusMap = [
        self::TRADE_STATUS_UNTREATED => '未处理',
        self::TRADE_STATUS_PENDING => '挂单',
        self::TRADE_STATUS_CONFIRM => '已确认',
        self::TRADE_STATUS_COMPLETE => '已完成(全部支付)',
        self::TRADE_STATUS_RETURN => '已退货',
        self::TRADE_STATUS_VOID => '已作废',
        self::TRADE_STATUS_REFUSE => '已拒绝',
        self::TRADE_STATUS_CANCEL => '已取消',
        self::TRADE_STATUS_CHECKOUT => '已反结账'
    ];

    public static $codeMap = [
        0 => '成功[OK]',
        1000 => '请求参数错误[详细说明]',
        1001 => 'sign计算错误[详细说明]',
        1002 => '没有权限访问该门店数据',
        2000 => '业务异常[详细说明]',
        2001 => '合作者标识错误',
        2003 => '订单不存在',
        2004 => '订单已经完成',
        2005 => '订单已经被取消',
        2006 => '订单已经被拒绝',
        2007 => '订单已经被作废',
        2008 => '订单状态不能被逆转',
        2100 => '商户信息不存在',
        2101 => '商户菜品不存在',
        3000 => '系统异常[详细说明]',
        3001 => '内部接口异常',
        -1 => '未知异常[UNKNOWN ERROR]'
    ];

    const TIME_TYPE_PLACE = 1;
    const TIME_TYPE_PAY = 2;

    public static $timeTypeMap = [
        1 => '下单时间',
        2 => '支付时间'
    ];

    const ORG_ALIPAY = 'ORG_ALIPAY';
    const ORG_WEIXINPAY = 'ORG_WEIXINPAY';
    const ORG_ZFT = 'ORG_ZFT';
    const ORG_KAYOU = 'ORG_KAYOU';
    const ORG_QIANBAO = 'ORG_QIANBAO';
    const ORG_UNIONPAY = 'ORG_UNIONPAY';
    const ORG_ICBC = 'ORG_ICBC';
    const ORG_BESTPAY = 'ORG_BESTPAY';
    const ORG_CCB = 'ORG_CCB';

    public static $orgMap = [
        self::ORG_ALIPAY => '支付宝',
        self::ORG_WEIXINPAY => '微信',
        self::ORG_ZFT => '支付通',
        self::ORG_KAYOU => '卡友',
        self::ORG_QIANBAO => '钱包生活',
        self::ORG_UNIONPAY => '银联云闪付',
        self::ORG_ICBC => '工商银行',
        self::ORG_BESTPAY => '电信翼支付',
        self::ORG_CCB => '建设银行'
    ];
}