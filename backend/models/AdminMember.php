<?php
namespace backend\models;

use common\exception\FinanceException;
use common\models\AdminFinance;
use common\models\AdminFinanceRecord;
use Yii;
use yii\base\Exception;
use yii\web\MethodNotAllowedHttpException;

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

    /**
     * 会员消费金额
     *
     * @param int $moduleId
     * @return float
     */
    public static function consumeMoney($moduleId)
    {
        if (app()->user->isGuest) {
           throw new FinanceException('查看收费模块，请登录');
        }
        $finance = AdminFinance::findOne(['module_id' => $moduleId, 'status' => 1]);
        if (!$finance) {
            return 0;
        }

        $modules = app()->params['charge_module_list'];
        $balance = app()->user->walletBalance;
        $fee = $finance->fee;
        $moduleName = $modules[$moduleId];

        if ($balance < $fee) {
            throw new FinanceException("余额:{$balance}不足, 无法查看{$moduleName}");
        }
        $adminFinanceRecord = new AdminFinanceRecord();
        $adminFinanceRecord->operate_type = 2;
        $adminFinanceRecord->member_id = app()->user->id;
        $adminFinanceRecord->amount = $fee;
        $adminFinanceRecord->operate_name = app()->user->name;
        $adminFinanceRecord->order_sn = $moduleId . date('Y-m-d H:i:s', time());
        $adminFinanceRecord->pay_sn = $moduleId . date('Y-m-d H:i:s', time());;
        $adminFinanceRecord->ip = app()->request->getUserIP();
        $adminFinanceRecord->remark = '查看：' . $moduleName . ',花费：'  . $fee;
        $adminFinanceRecord->save();

        return $finance->fee;
    }
}
