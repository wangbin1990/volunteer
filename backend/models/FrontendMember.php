<?php
namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

class FrontendMember extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 20;

    /**
     */
    public static function validatePassword($user, $password)
    {
        return ($user != null && Yii::$app->getSecurity()->validatePassword($password, $user->password));
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public static function login($username, $password, $rememberMe)
    {
        $user = AdminMember::findByUsername($username);
        if (self::validatePassword($user, $password) == true) {
            if (Yii::$app->user->login($user, $rememberMe ? 3600 * 24 * 30 : 0) == true) {
                // $user->initUserModuleList();
                // $user->initUserUrls();
                return true;
            }
        }
        return false;
    }


    /**
     * Finds user by username
     *
     * @param string $username            
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return AdminMember::findOne([
            'name' => $username,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentity($id)
    {
        return self::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * cookie
     *
     * @see \yii\web\IdentityInterface::getId()
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * cookie登录需要实现
     *
     * @see \yii\web\IdentityInterface::getAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * cookie登录需要实现
     *
     * @see \yii\web\IdentityInterface::getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}

?>