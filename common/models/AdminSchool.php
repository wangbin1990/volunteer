<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_school".
 *
 * @property string $id
 * @property string $name
 * @property string $success_rate
 * @property integer $location
 * @property integer $batch
 * @property integer $type
 * @property integer $spec
 * @property string $mold
 * @property string $sort
 * @property string $brief_intro
 * @property string $intro
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property string $create_time
 * @property string $update_time
 * @property string $professional_score
 */
class AdminSchool extends \backend\models\BaseModel
{

    /**
     * 用于保存所有的分类
     *
     * @var array
     */
    private $_cates = [];

    private $_specs = [];

    /**
     * 学校分类名
     */
    private $_relitaveName = [
        'batch' => '录取批次',
        'spec' => '特殊属性',
        'type' => '院校类型',
        'location' => '院校省份'
    ];

    /**
     * 学校科目
     */
    private $_mold = [
        0 => '文科',
        1 => '理科',
        2 => '其他',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'name',
                    'mold',
                ],
                'required'
            ],
            [
                [
                    'location',
                    'batch',
                    'type',
                    'status',
                    'sort'
                ],
                'integer'
            ],
            [
                [
                    'intro',
                    'brief_intro',
                    'mold',
                    'professional_score'
                ],
                'string'
            ],
            [
                [
                    'create_time',
                    'update_time'
                ],
                'safe'
            ],
            [
                [
                    'name'
                ],
                'string',
                'max' => 512
            ],
            [
                [
                    'success_rate'
                ],
                'string',
                'max' => 50
            ],
            [
                [
                    'phone'
                ],
                'string',
                'max' => 15
            ],
            [
                [
                    'email',
                    'website',
                ],
                'string',
                'max' => 255
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '学校名称',
            'success_rate' => '上线率',
            'location' => '所在地',
            'batch' => '批次',
            'type' => '类型',
            'spec' => '特殊属性',
            'mold' => '科目',
            'sort' => '排序',
            'status' => '是否免费',
            'brief_intro' => '招生简章',
            'intro' => '学校介绍',
            'phone' => '学校联系方式',
            'email' => '学校 邮箱',
            'website' => '学校网站',
            'score' => '历年分数',
            'professional_score' => '专业录取分数',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time'
        ];
    }

    /**
     * 获取学校所有的分类
     *
     * @return array 分类对应的数组
     */
    public function getCates()
    {
        if (empty($this->_cates)) {
            $this->_cates = AdminSchoolCates::getCates();
        }
        return $this->_cates;
    }

    /**
     * 获取学校所有的特殊分类
     *
     * @return array 分类对应的数组
     */
    public function getSpecs()
    {
        if (empty($this->_specs)) {
            $this->_specs = AdminSchoolCates::getSpecs();
        }
        return $this->_specs;
    }


    /**
     * 获取指定的分类通过name
     *
     * @param string $name
     * @return array
     */
    public function getCateByName($name)
    {
        if (!in_array($name, $this->_relitaveName)) {
            return [];
        }
        $cates = $this->getCates();
        foreach ($cates as $cate) {
            if ($cate['name'] == $name) {
                return $cate;
            }
        }
        return [];
    }

    /**
     * 获取指定的特殊分类通过name
     *
     * @param string $name
     * @return array
     */
    public function getSpecByName($name)
    {
        if (!in_array($name, $this->_relitaveName)) {
            return [];
        }
        $spec = $this->getSpecs();
        foreach ($spec as $cate) {
            if ($cate['name'] == $name) {
                return $cate;
            }
        }
        return [];
    }

    /**
     * 修改model的分类的属性为对应的name
     * return object
     */
    public function changeMoldeInfo($models)
    {
        if (empty($models)) {
            return $models;
        }
        $cates = $this->getCates();
        foreach ($models as $model) {
            foreach ($cates as $cate) {
                foreach ($this->_relitaveName as $key => $name) {
                    if ($cate['name'] == $name) {
                        if($key == 'spec') {
                            $spec = [];
                            foreach (explode(',', $model->$key) as $specId) {
                                foreach ($cate['children'] as $val) {
                                    if ($val['id'] == $specId) {
                                        $spec[] = $val['name'];
                                        break;
                                    }
                                }
                            }
                            $model->$key = implode('|', $spec);
                        } else {
                            foreach ($cate['children'] as $val) {
                                if ($val['id'] == $model->$key) {
                                    $model->$key = $val['name'];
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            $model->mold = $this->getMoldName($model->mold);
        }
        return $models;
    }

    /**
     * 获取学校的历年的分数
     *
     * @params number $id 学校ID
     * @return array 分数数据
     */
    public static function getScores($id)
    {
        if (! is_numeric($id)) {
            throw new InvalidParamException('不合法的参数:ID');
        }
        $obj = static::findOne($id);
        if ($obj) {
            return $obj->hasMany(AdminSchoolScore::className(), [
                'school_id' => 'id'
            ])
                ->orderBy('year')
                ->asArray()
                ->all();
        }
        return [];
    }

    /**
     * 获取科目名称 通过ID
     *
     * @param string $moldId
     * @return string
     */
    public function getMoldName($moldId)
    {
        return isset($this->_mold[$moldId]) ? $this->_mold[$moldId] : 'unkonw Mold Id';
    }

    /**
     * 获取科目
     *
     * @return array
     */
    public function getMold()
    {
        return $this->_mold;
    }

    /**
     *  获取分类名称 通过key
     *
     * @param string $key
     * @return string
     */
    public function getRelitaveName($key)
    {
        return isset($this->_relitaveName[$key]) ? $this->_relitaveName[$key] : 'unkonw relitave key';
    }

    /**
     * 批量获取学校
     *
     * @param array|string $condition
     * @param int $limit
     * @param string $orderBy
     */
    public static function getSchools($condition = [], $limit = null, $orderBy = '')
    {
        return static::find()->limit($limit)
            ->where($condition)
            ->orderBy(['id' => SORT_DESC])
            ->asArray()
            ->all();
    }

    public static function getSchoolsByDiffScore($condition, $params = [], $pageNo = 1, $pageSize = 20)
    {
        $sql = 'SELECT DISTINCT(a.id), a.* FROM admin_school as a
            left join admin_school_score as b on a.id=b.school_id
            where 1=1';

        if (!empty($condition[':batch'])) {
            $sql .= ' and a.batch=:batch';
        }
        if (isset($condition[':mold'])) {
            $sql .= ' and a.mold=:mold';
        }
        if (isset($condition[':spec'])) {
            $sql .= ' and a.spec=:spec';
        }
        if (!empty($condition[':location_id'])) {
            $sql .= ' and a.location=:location_id';
        }
        if (!empty($condition['school'])) {
            $sql .= " and a.name like '%" .$condition['school'] . "%'";
        }
        unset($condition['school']);

        if (!empty($params)) {
            if (isset($params[':low_score']) && isset($params[':high_score'])) {
                
                $sql .= ' GROUP BY a.id  HAVING min(b.diff_score) between :low_score and :high_score or max(b.diff_score) between :low_score and :high_score';
            } elseif (isset($params[':low_score'])) {
                $sql .= ' GROUP BY a.id  HAVING min(b.diff_score) > :low_score';
            } else {
                $sql .= ' GROUP BY a.id  HAVING max(b.diff_score) < :high_score';
            }
        }
        $offset = $pageSize * ($pageNo -1);

        $sql .= " order by a.sort asc limit {$offset}, {$pageSize}";
         //var_dump($sql);die;
        $condition = array_merge($condition, $params);
        return app()->db->createCommand($sql)
            ->bindValues($condition)
            ->queryAll();

    }

    public static function getSchoolsByDiffScoreCount($condition, $params = [])
    {
        $sql = 'SELECT DISTINCT(a.id), a.* FROM admin_school as a
            left join admin_school_score as b on a.id=b.school_id
            where 1=1';

        if (!empty($condition[':batch'])) {
            $sql .= ' and a.batch=:batch';
        }
        if (isset($condition[':mold'])) {
            $sql .= ' and a.mold=:mold';
        }
        if (isset($condition[':spec'])) {
            $sql .= ' and find_in_set("'  .  $condition[':spec'] .'",a.spec)';
            unset($condition[':spec']);
        }
        if (!empty($condition[':location_id'])) {
            $sql .= ' and a.location=:location_id';
        }
        if (!empty($condition['school'])) {
            $sql .= " and a.name like '%" .$condition['school'] . "%'";
        }
        unset($condition['school']);

        if (!empty($params)) {
            $year = date('Y');
            $threeYears = implode(',', [$year - 1, $year - 2 , $year - 3]);
            $sql .= ' AND b.year in (' . $threeYears . ')';
            if (isset($params[':low_score']) && isset($params[':high_score'])) {

                $sql .= ' GROUP BY a.id  HAVING min(b.diff_score) between :low_score and :high_score or max(b.diff_score) between :low_score and :high_score';
            } elseif (isset($params[':low_score'])) {
                $sql .= ' GROUP BY a.id  HAVING min(b.diff_score) > :low_score';
            } else {
                $sql .= ' GROUP BY a.id  HAVING max(b.diff_score) < :high_score';
            }
        }

        $sql .= " order by a.sort asc";
        //var_export($sql);die;
        $condition = array_merge($condition, $params);
        return app()->db->createCommand($sql)
            ->bindValues($condition)
            ->queryAll();

    }

    /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 暂时只支持text,hidden // select,checkbox,radio,file,password,
     * isEdit 是否允许编辑，如果允许编辑将在添加和修改时输入
     * isSearch 是否允许搜索
     * isDisplay 是否在列表中显示
     * isOrder 是否排序
     * udc - udc code，inputtype为select,checkbox,radio三个值时用到。
     * 特别字段：
     * id：主键。必须含有主键，统一都是id
     * create_date: 创建时间。生成的代码自动赋值
     * update_date: 修改时间。生成的代码自动赋值
     */
    public function getTableColumnInfo()
    {
        return array(
            'id' => array(
                'name' => 'id',
                'allowNull' => false,

                // 'autoIncrement' => true,
                // 'comment' => '',
                // 'dbType' => "int(10) unsigned",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => true,
                'phpType' => 'string',
                'precision' => '10',
                'scale' => '',
                'size' => '10',
                'type' => 'integer',
                'unsigned' => true,
                'label' => $this->getAttributeLabel('id'),
                'inputType' => 'hidden',
                'isEdit' => true,
                'isSearch' => true,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'name' => array(
                'name' => 'name',
                'allowNull' => false,

                // 'autoIncrement' => false,
                // 'comment' => '学校名称',
                // 'dbType' => "varchar(512)",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '512',
                'scale' => '',
                'size' => '512',
                'type' => 'string',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('name'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'success_rate' => array(
                'name' => 'success_rate',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '上线率',
                // 'dbType' => "varchar(50)",
                'defaultValue' => '0',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '50',
                'scale' => '',
                'size' => '50',
                'type' => 'string',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('success_rate'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'location' => array(
                'name' => 'location',
                'allowNull' => false,

                // 'autoIncrement' => false,
                // 'comment' => '所在地',
                // 'dbType' => "tinyint(4)",
                'defaultValue' => '0',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'integer',
                'precision' => '4',
                'scale' => '',
                'size' => '4',
                'type' => 'smallint',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('location'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'batch' => array(
                'name' => 'batch',
                'allowNull' => false,

                // 'autoIncrement' => false,
                // 'comment' => '批次',
                // 'dbType' => "tinyint(4)",
                'defaultValue' => '0',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'integer',
                'precision' => '4',
                'scale' => '',
                'size' => '4',
                'type' => 'smallint',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('batch'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'type' => array(
                'name' => 'type',
                'allowNull' => false,

                // 'autoIncrement' => false,
                // 'comment' => '类型',
                // 'dbType' => "tinyint(4)",
                'defaultValue' => '0',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'integer',
                'precision' => '4',
                'scale' => '',
                'size' => '4',
                'type' => 'smallint',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('type'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'spec' => array(
                'name' => 'spec',
                'allowNull' => false,

                // 'autoIncrement' => false,
                // 'comment' => '特殊属性',
                // 'dbType' => "tinyint(4)",
                'defaultValue' => '0',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'integer',
                'precision' => '4',
                'scale' => '',
                'size' => '4',
                'type' => 'smallint',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('spec'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'intro' => array(
                'name' => 'intro',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '学校介绍',
                // 'dbType' => "text",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '',
                'scale' => '',
                'size' => '',
                'type' => 'text',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('intro'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'phone' => array(
                'name' => 'phone',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '学校联系方式',
                // 'dbType' => "varchar(11)",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '11',
                'scale' => '',
                'size' => '11',
                'type' => 'string',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('phone'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'email' => array(
                'name' => 'email',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '学校 邮箱',
                // 'dbType' => "varchar(255)",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '255',
                'scale' => '',
                'size' => '255',
                'type' => 'string',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('email'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'website' => array(
                'name' => 'website',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '学校网站',
                // 'dbType' => "varchar(255)",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '255',
                'scale' => '',
                'size' => '255',
                'type' => 'string',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('website'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'score' => array(
                'name' => 'score',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '分数，保存id用，隔开',
                // 'dbType' => "varchar(255)",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '255',
                'scale' => '',
                'size' => '255',
                'type' => 'string',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('score'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'status' => array(
                'name' => 'status',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '是否开启收费',
                // 'dbType' => "varchar(255)",
                'defaultValue' => '1',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '255',
                'scale' => '',
                'size' => '255',
                'type' => 'string',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('status'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'create_time' => array(
                'name' => 'create_time',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '',
                // 'dbType' => "timestamp",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '',
                'scale' => '',
                'size' => '',
                'type' => 'timestamp',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('create_time'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',
            ,
            'update_time' => array(
                'name' => 'update_time',
                'allowNull' => true,

                // 'autoIncrement' => false,
                // 'comment' => '',
                // 'dbType' => "timestamp",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '',
                'scale' => '',
                'size' => '',
                'type' => 'timestamp',
                'unsigned' => false,
                'label' => $this->getAttributeLabel('update_time'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true
            )
            // 'udc'=>'',

        );
    }
}
