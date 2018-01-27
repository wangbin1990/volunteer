<?php
namespace common\base;
/**
 * Created by PhpStorm.
 * User: Wbin
 * Date: 2018/1/27
 * Time: 12:10
 */
use common\base\wechatPay\NativePay;
use common\base\wechatPay\lib\dataProcess\WxPayUnifiedOrder;
use common\base\wechatPay\lib\WxPayConfig;
use common\base\wechatPay\lib\WxPayNotify;
use common\base\wechatPay\WechatPayNotifyCallBack;

class WechatPay extends \yii\base\Component {

    /**
     * @var string
     */
    const BODY = '贵州志愿系统收费服务';
    /**
     * @var string
     */
    const GOODSTAG = '贵州志愿系统服务';

    /**
     * 获取需要支付url
     *
     * @param $memberId
     * @param $totalFee
     * @param $remark
     * @return mixed
     */
    public function goPay($memberId, $totalFee, $remark = '')
    {
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        //系统级参数
        $input->SetBody(static::BODY);
        $trade_no = date('Ymd') .
            substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $input->SetOut_trade_no($trade_no);
        $input->SetTime_start(date("YmdHis", time()));
        $input->SetTime_expire(date("YmdHis", time() + 600)); //二维码有效期10分钟
        $input->SetGoods_tag(static::GOODSTAG);
        $input->SetTrade_type("NATIVE");
        $input->SetNotify_url(app()->urlManager->createAbsoluteUrl('api/wxpay-notify')); //回调地址写成前台的地址
        $input->SetProduct_id("123456789");

        //业务参数
        $attach = implode(';', [$memberId, app()->user->uname, $remark]);
        $input->SetAttach($attach);
        $input->SetTotal_fee($totalFee * 100);

        $result = $notify->GetPayUrl($input);
        //失败返回 return_code:FAIL, return_msg:time_expire时间过短，刷卡至少1分钟，其他5分钟
        if ('FAIL' == $result['result_code']) {
            return [
                'data' => [],
                'message' => $result['return_msg'],
                'code' => -1,
            ];
        }
        return [
            'data' => $result["code_url"],
            'message' => $result['return_msg'],
            'code' => 0,
        ];
    }

    /**
     * 异步回调处理
     *
     * @return void
     */
    public function notify()
    {
        $notify = new WechatPayNotifyCallBack();
        $notify->Handle(true);
    }

}