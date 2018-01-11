<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_school_score".
 *
 * @property string $id
 * @property string $school_id
 * @property string $year
 * @property string $high_score
 * @property string $agv_score
 * @property string $low_score
 * @property string $diff_score
 * @property string $plan_count
 * @property string $rank
 */
class AdminSchoolScore extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_school_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'school_id'], 'required'],
            [['year'], 'safe'],
            [['high_score', 'agv_score', 'low_score', 'diff_score', 'plan_count', 'rank', 'batch_id', 'mold_id','number'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => '年份',
            'school_id' => '学校',
            'high_score' => '最高分',
            'agv_score' => '省控线',
            'low_score' => '最低录取分',
            'diff_score' => '分差',
            'plan_count' => '计划数',
            'number' => '投档数',
            'rank' => '排位',
             'batch_id' => '批次',
            'mold_id' => '科目',
        ];
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
//                         'dbType' => "int(10) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
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
		'year' => array(
                        'name' => 'year',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '年份',
//                         'dbType' => "year(4)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'date',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('year'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'high_score' => array(
                        'name' => 'high_score',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '最高分',
//                         'dbType' => "int(3) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '3',
                        'scale' => '',
                        'size' => '3',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('high_score'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'agv_score' => array(
                        'name' => 'agv_score',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '平均分',
//                         'dbType' => "int(3) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '3',
                        'scale' => '',
                        'size' => '3',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('avg_score'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'low_score' => array(
                        'name' => 'low_score',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '最低分',
//                         'dbType' => "int(3) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '3',
                        'scale' => '',
                        'size' => '3',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('low_score'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'diff_score' => array(
                        'name' => 'diff_score',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '分差',
//                         'dbType' => "int(2) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '2',
                        'scale' => '',
                        'size' => '2',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('diff_score'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'plan_count' => array(
                        'name' => 'plan_count',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '计划数',
//                         'dbType' => "int(8) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('plan_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),

        'number' => array(
                        'name' => 'number',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '计划数',
//                         'dbType' => "int(8) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '4',
                        'scale' => '',
                        'size' => '4',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('number'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'rank' => array(
                        'name' => 'rank',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '排位',
//                         'dbType' => "int(2) unsigned",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '2',
                        'scale' => '',
                        'size' => '2',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('rank'),
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
