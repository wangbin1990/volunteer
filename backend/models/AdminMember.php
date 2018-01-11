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
            [['create_date', 'update_date'], 'safe'],
            [['name',  'create_user'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 200],
            [['last_ip'], 'string', 'max' => 50],
            [['update_user'], 'string', 'max' => 101]
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
            'num' => '权限',
            'status' => '状态',
            'create_user' => '创建人',
            'create_date' => '创建时间',
            'update_user' => '更新人',
            'update_date' => '更新时间',
        ];
    }


  /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 包含text,select,checkbox,radio,file,password,hidden
     * isEdit   是否允许编辑，如果允许编辑将在添加和修改时输入
     * isSearch 是否允许搜索
     * isDisplay 是否在列表中显示
     * isOrder 是否排序
     * udc - udc code，inputtype为select,checkbox,radio三个值时用到。
     * 特别字段：
     * id：主键。必须含有主键，统一都是id
     * create_date: 创建时间。生成的代码自动赋值
     * update_date: 修改时间。生成的代码自动赋值
     */
    public function getTableColumnInfo(){
        return array(
        'id' => array(
                        'name' => 'id',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => '',
//                         'dbType' => "bigint(20) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'bigint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('id'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'name' => array(
                        'name' => 'name',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '用户名',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('name'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'password' => array(
                        'name' => 'password',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '密码',
//                         'dbType' => "varchar(200)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '200',
                        'scale' => '',
                        'size' => '200',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('password'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'last_ip' => array(
                        'name' => 'last_ip',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '最近一次登录ip',
//                         'dbType' => "varchar(50)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '50',
                        'scale' => '',
                        'size' => '50',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('last_ip'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'num' => array(
                        'name' => 'num',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '域账号',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('num'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'status' => array(
                        'name' => 'status',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '状态',
//                         'dbType' => "smallint(6)",
                        'defaultValue' => '10',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '6',
                        'scale' => '',
                        'size' => '6',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('status'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'create_user' => array(
                        'name' => 'create_user',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '创建人',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('create_user'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'create_date' => array(
                        'name' => 'create_date',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '创建时间',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('create_date'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'update_user' => array(
                        'name' => 'update_user',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '更新人',
//                         'dbType' => "varchar(101)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '101',
                        'scale' => '',
                        'size' => '101',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('update_user'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
        'update_date' => array(
                        'name' => 'update_date',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '更新时间',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('update_date'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
                );
        
    }
 
}
