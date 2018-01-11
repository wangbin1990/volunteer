<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_click_time".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $school_id
 * @property string $click_time
 */
class adminClickTime extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_click_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'school_id'], 'required'],
            [['user_id', 'school_id'], 'integer'],
            [['click_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'school_id' => 'School ID',
            'click_time' => '48小时内第一次点击时间',
        ];
    }

    /**
     * 检测当前是否在可用范围内
     *
     * @param number $schoolId
     * @return boolean
     */
    public static function checkStatus($schoolId)
    {
        $obj = static::find()
            ->where(['school_id' => $schoolId, 'user_id' => app()->user->id])
            ->andWhere(['>', 'click_time', time()-72 * 3600])
            ->all();
        return !empty($obj) ? true : false;
    }

      /**
     * 过滤需要权限的学校
     *
     * @param array $schoolIds
     * @return boolean
     */
    public static function filterSchools(array $schoolIds)
    {
        $obj = static::find()
            ->where(['user_id' => app()->user->id])
            ->andWhere(['>', 'click_time', time()-72 * 3600])
            ->asArray()
            ->all();

        return !empty($obj) ? array_diff($schoolIds, i_array_column($obj, 'school_id')) : $schoolIds;
    }

  /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 暂时只支持text,hidden  // select,checkbox,radio,file,password,
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
//                         'dbType' => "mediumint(8) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('id'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'user_id' => array(
                        'name' => 'user_id',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '',
//                         'dbType' => "smallint(5) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '5',
                        'scale' => '',
                        'size' => '5',
                        'type' => 'smallint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('user_id'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'school_id' => array(
                        'name' => 'school_id',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '',
//                         'dbType' => "smallint(5) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '5',
                        'scale' => '',
                        'size' => '5',
                        'type' => 'smallint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('school_id'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'click_time' => array(
                        'name' => 'click_time',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '48小时内第一次点击时间',
//                         'dbType' => "timestamp",
                        'defaultValue' => '0000-00-00 00:00:00',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'timestamp',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('click_time'),
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
