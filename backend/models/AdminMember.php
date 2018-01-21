<?php
namespace backend\models;

use Yii;
/**
 * This is the model class for table "admin_user".
 *
 * @property string $id
 * @property string $uname
 * @property string $password
 * @property string $auth_key
 * @property string $last_ip
 * @property string $is_online
 * @property string $domain_account
 * @property integer $status
 * @property string $create_user
 * @property string $create_date
 * @property string $update_user
 * @property string $update_date
 * @property string $wallet_balance
 * @property string $wallet_create_time
 *
 * @property AdminUserRole[] $adminUserRoles
 * @property SystemUserRole[] $systemUserRoles
 */
class AdminMember extends BackendUser
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_member';
    }
    
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE
        ]);
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne([
            'name' => $username,
            'status' => self::STATUS_ACTIVE
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'password', 'create_user', 'create_date', 'update_user', 'update_date'], 'required'],
            [['status','num'], 'integer'],
            [['wallet_balance'], 'number'],
            [['create_date', 'update_date'], 'safe'],
            [['name',  'create_user'], 'string', 'max' => 100],
            [['password', 'prefix_name'], 'string', 'max' => 200],
            [['last_ip'], 'string', 'max' => 50],
            [['update_user'], 'string', 'max' => 101],
            [['wallet_create_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '用户名',
            'password' => '密码',
            'last_ip' => '最近一次登录ip',
            'num' => '权限次数',
            'status' => '状态',
            'create_user' => '创建人',
            'create_date' => '创建时间',
            'update_user' => '更新人',
            'update_date' => '更新时间',
            'wallet_balance' => '账户余额',
            'wallet_create_time' => '充值时间',
            'prefix_name' => '前缀',
        ];
    }
}
