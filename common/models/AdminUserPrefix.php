<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_user_preifx".
 *
 * @property integer $id
 * @property string $prefix
 * @property integer $user_id
 * @property string $update_user
 * @property string $update_date
 */
class AdminUserPrefix extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user_prefix';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['update_time'], 'safe'],
            [['prefix', 'update_user'], 'string', 'max' => 255],
            [['prefix', 'user_id'], 'unique', 'targetAttribute' => ['prefix', 'user_id'], 'message' => 'The combination of Prefix and User ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prefix' => '前缀名称',
            'user_id' => '业务员名',
            'update_time' => '最后修改时间',
            'update_user' => '最后修该人',
        ];
    }
}
