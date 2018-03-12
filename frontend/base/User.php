<?php
namespace frontend\base;

use backend\models\AdminMember;

/**
 * rewrite User 
 */
class User extends \yii\web\User
{
    /**
     * @var string the session variable name used to store the value of [[id]].
     */
    public $idParam = '__frontId';

    /**
     * 获取个人信息
     *
     * @param string|null $property
     * @return array|null
     */
    public function getUserInfo($property = null)
    {
        $userInfo = app()->session->get('userInfo');
        if ($userInfo)  {
            if(!$property) {
                return $userInfo;
            }
            return isset($userInfo[$property]) ? $userInfo[$property] : null;
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function __get($name)
    {   $adminMember = new AdminMember();
        $memberPropertys = $adminMember->getAttributes();
        if (key_exists($name, $memberPropertys)) {
           return $this->getUserInfo($name);
        }
        return parent::__get($name); // TODO: Change the autogenerated stub
    }

    /**
     * 获取金额
     *
     * @return float
     */
    public function getWalletBalance()
    {
        if (!$this->getIsGuest()) {
            $member = AdminMember::findOne($this->id);
            if (!$member) {
                return 0;
            }
            return  $member->wallet_balance;
        }
        return 0;
    }
}
