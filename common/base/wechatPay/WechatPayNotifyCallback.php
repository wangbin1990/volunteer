<?php
/**
 * Created by PhpStorm.
 * User: Wbin
 * Date: 2018/1/27
 * Time: 17:44
 */
namespace common\base\wechatPay;

use common\base\wechatPay\lib\WxPayNotify;
use common\models\AdminFinanceRecord;

class WechatPayNotifyCallBack extends WxPayNotify
{
    /**
     * 异步回调校验
     *
     * @param $openId
     * @param $product_id
     * @return 成功时返回，其他抛异常
     */
    public function unifiedorder($openId, $product_id)
    {
        //统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetOpenid($openId);
        $input->SetProduct_id($product_id);
        $result = WxPayApi::unifiedOrder($input);
        \yii::info(var_export($result, true), 'notify_unifiedorder_data');
        return $result;
    }

    /**
     * 处理回调数据
     *
     * @param array $data
     * @param string $msg
     * @return bool
     */
    public function NotifyProcess($data, &$msg)
    {
        //echo "处理回调";
        \yii::info(var_export($data, true), 'wechatPay_callback_data');

//        if(!array_key_exists("openid", $data) ||
//            !array_key_exists("product_id", $data))
//        {
//            $msg = "回调数据异常";
//            return false;
//        }
//
//        $openid = $data["openid"];
//        $product_id = $data["product_id"];
//
//        //统一下单
//        $result = $this->unifiedorder($openid, $product_id);
//        if(!array_key_exists("appid", $result) ||
//            !array_key_exists("mch_id", $result) ||
//            !array_key_exists("prepay_id", $result))
//        {
//            $msg = "统一下单失败";
//            return false;
//        }

        //$this->SetData("appid", $result["appid"]);
        //$this->SetData("mch_id", $result["mch_id"]);
        //$this->SetData("prepay_id", $result["prepay_id"]);
        //$this->SetData("nonce_str", WxPayApi::getNonceStr());
        //$this->SetData("result_code", "SUCCESS");
        //$this->SetData("err_code_des", "OK");

        // TODO 增加支付记录
        $attachData = explode(';', $data['attach'], 3);
        $adminFinanceRecord = new AdminFinanceRecord();
        $modelData = [
            'order_sn' => $data['out_trade_no'],
            'remark' => $attachData[2],
            'member_id' => $attachData[0],
            'amount' => $data['total_fee'] / 100,
            'pay_sn' => $data['transaction_id'],
            'operate_type' => 1,
            'operate_name' => $attachData[1],
            'create_time' => time(),
        ];
        if ($adminFinanceRecord::findOne(['order_sn' => $modelData['order_sn'], 'member_id' => $modelData['member_id']])) {
            $this->SetData("result_code", "SUCCESS");
            return true;
        }

        if ($adminFinanceRecord->load($modelData, '')  && $adminFinanceRecord->validate()) {
            $adminFinanceRecord->save(false);
        }
        $this->SetData("result_code", "SUCCESS");

        return true;
    }
}
