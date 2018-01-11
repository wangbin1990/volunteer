<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_school_cates".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 */
class AdminSchoolCates extends \backend\models\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_school_cates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'code',
                    'name'
                ],
                'required'
            ],
            [
                [
                    'create_date',
                    'update_date'
                ],
                'safe'
            ],
            [
                [
                    'code',
                    'name',
                    'create_user',
                    'update_user'
                ],
                'string',
                'max' => 50
            ],
            [
                [
                    'des'
                ],
                'string',
                'max' => 400
            ]
        ];
    }

    public static function getCates()
    {
        $data = static::find()->asArray()->all();
        $data = static::handleDate($data, 0);
        return $data;
    }

    public static function getSpecs()
    {
        $data = static::find()->asArray()->all();
        $data = static::handleDate($data, 0);
        return $data;
    }
    public static function handleDate($cates, $pid)
    {
        $tree = array(); // 每次都声明一个新数组用来放子元素
        foreach ($cates as $v) {
            if ($v['parent_id'] == $pid) { // 匹配子记录
                $v['children'] = static::handleDate($cates, $v['id']); // 递归获取子记录
                if ($v['children'] == null) {
                    unset($v['children']); // 如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）
                }
                $tree[] = $v; // 将记录存入新数组
            }
        }
        return $tree;
    }
}
