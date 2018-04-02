<?php

namespace frontend\controllers;

use common\models\AdminBatchScore;
use Yii;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\ContactForm;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AdminSchool;
use common\models\AdminSchoolScore;
use yii\web\NotFoundHttpException;
use backend\models\AdminMember;
use common\models\AdminUserPrefix;
use backend\models\AdminArticleContent;
use backend\models\AdminArticleType;
use common\utils\CommonFun;
use yii\web\Response;
use yii\web\Session;
use common\models\adminClickTime;
use yii\base\ErrorException;
use yii\data\Pagination;


/**
 * Site controller
 */
class SiteController extends Controller
{

    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => [
                     'logout',
                     //'lsucc',
                     //'school-list',
                     'simulate',
                     'get-pay-code',
                 ],
                 'rules' => [
                     [
                         'actions' => [
                             'logout',
                             //'lsucc',
                             //'school-list',
                             'simulate',
                             'get-pay-code'
                         ],
                         'allow' => true,
                         'roles' => [
                             '@'
                         ]
                     ]
                 ]
             ],
         ];
     }


    /**
     * 志愿系统首页
     */
    public function actionIndex()
    {
        if (app()->request->isPost) {
            app()->cache->set('index_cache', app()->request->post('img'));
        }
        $session = Yii::$app->session;
        app()->user->isGuest;
        $schools = AdminSchool::getSchools(['status' => '1'], 7);
        //政策法规
        //$content_a = AdminArticleContent::getArticleContent(['type_id' => '207','status' => '1']);
        $allTypes = AdminArticleType::find()->where(['status' => 1])->all();

        $articles = [];
        foreach ($allTypes as $type) {
            $articles[$type['name']] = $type->getContents()
                ->where(['status' => 1])
                ->asArray()
                ->orderBy('update_date desc')
                ->limit(7)
                ->all();
        }
        return $this->render('index', [
            'schools' => $schools,
            'articles' => $articles,
            'username' => $session['username'],
            'password' => $session['password'],
            'img' => app()->cache->get('index_cache'),
        ]);

        if (isset($session['username']) && isset($session['password'])) {
            return $this->render('index', [
                'schools' => $schools,
                'content_a' => $content_a,
                'content_b' => $content_b,
                'content_c' => $content_c,
                'content_d' => $content_d,
                'content_e' => $content_e,
                'username' => $session['username'],
                'password' => $session['password'],
                'img' => app()->cache->get('index_cache'),
            ]);
        } else {
            return $this->render('index', [
                'schools' => $schools,
                'content_a' => $content_a,
                'content_b' => $content_b,
                'content_c' => $content_c,
                'content_d' => $content_d,
                'content_e' => $content_e,
                'img' => app()->cache->get('index_cache'),
            ]);
        }
    }

    /**
     * 学校详情页
     * @paream numer $id 学校id
     */
    public function actionSchool($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidParamException('ID 输入不合法');
        }
        $school = AdminSchool::findOne($id);

        if (!empty($school)) {
            if ($school['status'] == 0) {
                if (0 && app()->user->isGuest) {
                    throw new InvalidParamException('这是非免费学校，请登录');
                } else {
                    if (!adminClickTime::checkStatus($id)) {
                        //查询总次数
                        $adminMember = AdminMember::findOne(app()->user->id);
                        if (($num = $adminMember['num']) > 0) {
                            $model = new adminClickTime();
                            $model->load(
                                [
                                    'user_id' => app()->user->id,
                                    'school_id' => $id,
                                    'click_time' => time(),
                                ],
                                ''
                            );
                            if ($model->save()) {
                                $adminMember->num = $num - 1;
                                $adminMember->update_date = date('Y-m-d H:i:s', time());
                                $adminMember->update();

                            }
                        } else {
                            //throw new InvalidParamException('查看权限次数已用完');
                        }
                    }
                }

            }
        } else {
            throw new InvalidParamException('找不到当前的学校');
        }

        $scores = AdminSchool::getScores($id);
        $diff_score = [];
        $plan_count = [];
        $rank = [];
        foreach ($scores as $key => $score) {
            $diff_score[$key]['year'] = $score['year'];
            $diff_score[$key]['diff_score'] = (int)$score['diff_score'];
            $plan_count[$key]['year'] = $score['year'];
            $plan_count[$key]['plan_count'] = (int)$score['plan_count'];
            $rank[$key]['year'] = $score['year'];
            $rank[$key]['rank'] = (int)$score['rank'];
        }

        return $this->render('school', [
            'school' => $school,
            'scores' => $scores,
            'diff_score' => json_encode($diff_score),
            'plan_count' => json_encode($plan_count),
            'rank' => json_encode($rank)
        ]);
    }

    /**
     * 文章列表
     */
    public function actionArticle($id)
    {
        $content = AdminArticleContent::getArticleContent(['id' => $id, 'status' => '1']);
        return $this->render('article', [
            'content' => $content,
        ]);
    }

    /**
     * 志愿模拟
     */
    public function actionVolunteerSimulation()
    {
        return $this->render('volunteer-simulation');
    }

    /**
     * 注册会员
     */
    public function actionRegister()
    {
        return $this->render('register');
    }


    /**
     * 志愿模拟进入选择学校页面
     */
    public function actionSelectSchool()
    {
        if (app()->request->isPost) {
            $data= app()->request->post();
            $scores = AdminBatchScore::find()
                ->select('batch_no,score')
                ->where(['year' => intval($data['year']), 'mold' => intval($data['mold'])] )->asArray()->indexBy('batch_no')->all();
            if (!$scores) {
                throw new InvalidParamException('找不到当前年份的数据');
            }
            if (!isset($data['grade']) || !is_numeric($data['grade'])) {
                throw new InvalidParamException('输入的分数为空或格式不正确');
            }

            if ($data['grade'] < $scores[2]['score']) {
                throw new InvalidParamException('分数小于二本分数线');
            } elseif ($data['grade'] > $scores[2]['score'] && $data['grade'] < $scores[3]['score']) {
                $batchIds = $data['batchIds'] = [6, 7];
                $batch_3 = intval($data['batch_3']);
                $data['batch_3'] = $batch_3 = ($batch_3 > 8 || $batch_3 < 0) ? 0 : $batch_3;
                $data['batch_2'] = $batch_2 = 8 - $batch_3;
                $data['diff_score'] = $data['grade'] - $scores[2]['score'];
            } elseif ($data['grade'] > $scores[1]['score']) {
                if (isset($data['yiben']) && 2 == $data['yiben']) {
                    $batchIds = $data['batchIds'] = [6];
                    $data['diff_score'] = $data['grade'] - $scores[3]['score'];
                } else {
                    $batchIds = $data['batchIds'] = [5];
                    $data['diff_score'] = $data['grade'] - $scores[1]['score'];
                }

            } elseif ($data['grade'] > $scores[3]['score'] && $data['grade'] < $scores[1]['score']) {
                $batch_3 = intval($data['batch_3']);
                $data['batch_3'] = $batch_3 = ($batch_3 > 8 || $batch_3 < 0) ? 0 : $batch_3;
                $data['batch_2'] = $batch_2 = 8 - $batch_3;
                $batchIds = $data['batchIds'] = [6];
                $data['diff_score3'] = $data['grade'] - $scores[2]['score'];
            }
            $schools = [];
            foreach ([1, 2 , 3, 4, 5, 6 , 7, 8] as $item) {
                $data['item'] = $item;

                if (in_array(7, $batchIds)) {
                    if($batch_2 >= $item) {
                        $data['batchIds'] = [6];
                    } else {
                        $data['batchIds'] = [7];
                    }
                }

                if (isset($data['diff_score3'])) {
                    if ($batch_2 >= $item) {
                        $data['diff_score'] = $data['grade'] - $scores[3]['score'];
                    } else {
                        $data['diff_score'] = $data['grade'] - $scores[2]['score'];
                    }

                }

                $schools[$item] = $this->getParallelSchool($data);
            }
            $data['schools']  = $schools;
            if (!empty($schools)) {
                //智能填报扣费
                AdminMember::consumeMoney(4, md5(json_encode($data)));
            }
            return $this->render('select-school', [
                'data' => $data,
            ]);
        } else {
            app()->response->redirect(Url::toRoute('site/volunteer-simulation'));
        }
    }

    /**
     * 登录后，跳转
     *
     */
    public function actionLogin()
    {

        if (app()->request->isPost) {
            app()->response->format = Response::FORMAT_JSON;
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');
            $rememberMe = Yii::$app->request->post('isRemeberMe');
            $rememberMe = $rememberMe == 'y' ? true : false;
            $session = Yii::$app->session;
            if (app()->user->isGuest) {
                if (AdminMember::login_new($username, $password, $rememberMe) == true) {
                    AdminMember::updateAll([
                        'last_ip' => CommonFun::getClientIp()
                    ], [
                        'name' => $username
                    ]);
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    return ['code' => 0, 'msg' => '登录成功', 'data' => []];
                } else {
                    return ['code' => -1, 'msg' => '用户或密码错误', 'data' => []];
                }
            } else {
                return ['code' => -1, 'msg' => '用户已登录', 'data' => []];
            }
        }
        return ['code' => -1, 'msg' => '权限不允许', 'data' => []];
    }

    public function actionLogout()
    {
        app()->user->logout();
        return $this->goHome();
    }

    public function actionLsucc()
    {
        $session = Yii::$app->session;
        // if (!app()->user->isGuest) {
            $schoolObj = new AdminSchool();
            $cate = $schoolObj->getCateByName($schoolObj->getRelitaveName('batch'));
            $spec = $schoolObj->getSpecByName($schoolObj->getRelitaveName('spec'));
            $mold = $schoolObj->getMold();
            if (empty($cate) || empty($mold || empty($spec))) {
                app()->session->setFlash('warning', '没有可筛选的学校');
            }
            //dump($cate);
            return $this->render('login-succ', [
                'cate' => $cate,
                'spec' => $spec,
                'mold' => $mold,
            ]);
        // } 
        // else {
        //     echo "<h1><a href='index'>非法访问，请前往首页登录！</a></h1>";
        // }
    }

    /**
     * 选择学校
     *
     * @param string|int $batch
     *            批次
     * @param string|int $mold
     *            科目
     * @return string
     */
    public function actionSchoolList($batch = null, $mold = null, $spec = null)
    {
        $conditions = [];
        $params = [];
        $location_id = 0;
        if (isset($batch)) {
            $conditions[':batch'] = intval($batch);
        }
        if (isset($mold)) {
            $mold = intval($mold);
            $conditions[':mold'] = "{$mold}";
        }
        if ($spec != 'null') {
            $spec = intval($spec);
            $conditions[':spec'] = "{$spec}";
        } else {
            $conditions[':spec'] = "9,10,11,12,63";
        }
        $postParams = app()->request->get();
        if (isset($postParams['location_id']) && $postParams['location_id'] > 0) {
            //按地区筛选扣费
            AdminMember::consumeMoney(1, md5($postParams['location_id']));
            $location_id = $conditions[':location_id'] = intval($postParams['location_id']);
        }

        if (isset($postParams['school'])) {
            $conditions['school'] = \yii\helpers\Html::encode(trim($postParams['school']));
        }
        if (isset($postParams['highScore']) && $postParams['highScore'] > 0) {
            $params[':high_score'] = intval($postParams['highScore']);
        }
        if (isset($postParams['lowScore']) && $postParams['lowScore'] > 0) {
            $params[':low_score'] = intval($postParams['lowScore']);
        }
        if(isset($postParams['highScore']) && $postParams['highScore'] > 0 || isset($postParams['lowScore']) && $postParams['lowScore'] > 0) {
            //按分bc分差筛选扣费
            $val = (isset($postParams['highScore']) ? $postParams['highScore'] : '') .
                (isset($postParams['lowScore']) ? $postParams['lowScore'] : '');
            AdminMember::consumeMoney(2, md5($val));
        }
        if (isset($params[':high_score'])
            && isset($params[':lowScore'])
            && $params[':high_score'] < $params[':lowScore']
        ) {
            $tempScore = $params[':high_score'];
            $params[':high_score'] = $params[':low_score'];
            $params[':low_score'] = $tempScore;
        }

        $schoolObj = new AdminSchool();
        $cate = $schoolObj->getCateByName($schoolObj->getRelitaveName('batch'));
        $locationCate = $schoolObj->getCateByName($schoolObj->getRelitaveName('location'));

        $batchName = '';
        foreach ($cate['children'] as $item) {
            if ($item['id'] == $batch) {
                $batchName = $item['name'];
            }
        }
        //$allSchools = AdminSchool::getSchoolsByDiffScoreCount($conditions, $params);
        $schools = AdminSchool::getSchoolsByDiffScoreCount($conditions, $params);
        // $pagination = new Pagination(['totalCount' => count($allSchools)]);

        // $pageNo = (isset($postParams['page']) && $postParams['page']) > 0 ? $postParams['page'] : 1;
        // $schools = AdminSchool::getSchoolsByDiffScore($conditions, $params, intval($pageNo));

        if (empty($schools)) {
            app()->session->setFlash('warning', '没有搜索到的学校');
        }

        $params['school'] = isset($conditions['school']) ? $conditions['school'] : '';

        return $this->render('school-list', [
            'schools' => $schools,
            'cate' => $cate,
            'params' => $params,
            'batch' => $batch,
            'mold' => $mold,
            'batchName' => $batchName,
            'locationCate' => $locationCate,
            'location_id' => $location_id,
            // 'pagination' => $pagination,
        ]);
    }

    /**
     * 模拟志愿
     */
    public function actionSimulate()
    {
        $data = app()->request->post();
        $data['school'] = array_filter($data['school']);
        
        if (empty($data['school'])) {
            throw new InvalidParamException('没有选择对比的学校');
        } else {

            $schools = AdminSchool::getSchools(['in', 'id', $data['school']]);
            if (!empty($schools)) {
                $scores = AdminSchoolScore::find()
                    ->where(['in', 'school_id', $data['school']])
                    ->asArray()
                    ->all();
                $years = [];
                foreach ($schools as $key => &$school) {
                    $school['scores'] = AdminSchool::getScores($school['id']);
                    $chart[$key]['name'] = $school['name'];
                    foreach ($school['scores'] as $score) {
                        $chart[$key]['data'][$score['year']]['diff_score'] = $score['diff_score'];
                        $chart[$key]['data'][$score['year']]['plan_count'] = $score['plan_count'];
                        $chart[$key]['data'][$score['year']]['rank'] = $score['rank'];
                    }
                    foreach ($school['scores'] as $score) {
                        $chart2[$key]['data'][$score['year']] = $score['diff_score'];
                    }
                    //$chart[$key]['data'] = array_column($school['scores'], 'diff_score');
                    $years = array_merge(i_array_column($school['scores'], 'year'), $years);
                }
                $years = array_unique($years);
                sort($years);
                $chart1 = $chart;

                foreach ($years as $year) {
                    foreach ($chart1 as $k => &$value) {
                        if (!isset($value['data']) || !in_array($year, array_keys($value['data']))) {
                            $chart[$k]['data'][$year]['diff_score'] = 0;
                            $chart[$k]['data'][$year]['plan_count'] = 0;
                            $chart[$k]['data'][$year]['rank'] = 0;
                            $value['data'][$year] = 0;
                        } else {
                            $value['data'][$year] = $value['data'][$year]['diff_score'];
                        }
                        unset($value['data']['diff_score']);
                        unset($value['data']['plan_count']);
                        unset($value['data']['rank']);
                    }
                }
                foreach ($chart1 as &$item) {
                    ksort($item['data']);
                    $item['data'] = array_values($item['data']);
                }
                foreach ($chart as &$item) {
                    ksort($item['data']);
                }
            }
        }
        $chart2 = $chart;
        foreach ($chart as $key => $valuezhao) {
            $schools_d[$key]['year'] = $valuezhao['data']['2017']["diff_score"];
            $schools_d[$key]['name'] = $valuezhao['name'];
        }
        rsort($schools_d);
        foreach ($schools_d as $key1 => $value1) {
            # code...
            // var_dump($schools_d[$key1]['name']);
            foreach ($chart2 as $key2 => $value2) {
                // var_dump($chart2[$key2]['name']);
                if ($chart2[$key2]['name'] == $schools_d[$key1]['name']) {
                    $chart[$key1] = $value2;
                }
            }
        }

        //院校数据对比
        //AdminMember::consumeMoney(3);
        return $this->render('simulate', [
            'isCompare' => 0,
            'schools' => $schools,
            'years' => $years,
            'chart' => $chart,
            'chart1' => $chart1,
        ]);
    }

    /**
     * 模拟志愿
     */
    public function actionCompareSchool()
    {
        $data = app()->request->post();
        $data = array_filter($data);
        if (empty($data['checkSchool'])) {
            throw new InvalidParamException('没有选择对比的学校');
        } else {
            $schools = AdminSchool::getSchools(['in', 'id', $data['checkSchool']]);
            if (!empty($schools)) {
                $scores = AdminSchoolScore::find()
                    ->where(['in', 'school_id', $data['checkSchool']])
                    ->asArray()
                    ->all();
                $years = [];
                foreach ($schools as $key => &$school) {
                    $school['scores'] = AdminSchool::getScores($school['id']);
                    $chart[$key]['name'] = $school['name'];
                    foreach ($school['scores'] as $score) {
                        $chart[$key]['data'][$score['year']]['diff_score'] = $score['diff_score'];
                        $chart[$key]['data'][$score['year']]['plan_count'] = $score['plan_count'];
                        $chart[$key]['data'][$score['year']]['rank'] = $score['rank'];
                    }
                    foreach ($school['scores'] as $score) {
                        $chart2[$key]['data'][$score['year']] = $score['diff_score'];
                    }
                    //$chart[$key]['data'] = array_column($school['scores'], 'diff_score');
                    $years = array_merge(i_array_column($school['scores'], 'year'), $years);
                }
                $years = array_unique($years);
                sort($years);
                $chart1 = $chart;

                foreach ($years as $year) {
                    foreach ($chart1 as $k => &$value) {
                        if (!isset($value['data']) || !in_array($year, array_keys($value['data']))) {
                            $chart[$k]['data'][$year]['diff_score'] = 0;
                            $chart[$k]['data'][$year]['plan_count'] = 0;
                            $chart[$k]['data'][$year]['rank'] = 0;
                            $value['data'][$year] = 0;
                        } else {
                            $value['data'][$year] = $value['data'][$year]['diff_score'];
                        }
                        unset($value['data']['diff_score']);
                        unset($value['data']['plan_count']);
                        unset($value['data']['rank']);
                    }
                }
                foreach ($chart1 as &$item) {
                    ksort($item['data']);
                    $item['data'] = array_values($item['data']);
                }
                foreach ($chart as &$item) {
                    ksort($item['data']);
                }
            }

            $chart2 = $chart;
            foreach ($chart as $key => $valuezhao) {
                $schools_d[$key]['year'] = $valuezhao['data']['2017']["diff_score"];
                $schools_d[$key]['name'] = $valuezhao['name'];
            }
            rsort($schools_d);
            foreach ($schools_d as $key1 => $value1) {
                # code...
                // var_dump($schools_d[$key1]['name']);
                foreach ($chart2 as $key2 => $value2) {
                    // var_dump($chart2[$key2]['name']);
                    if ($chart2[$key2]['name'] == $schools_d[$key1]['name']) {
                        $chart[$key1] = $value2;
                    }
                }
            }
        }

        //院校数据对比
        AdminMember::consumeMoney(3, md5(json_encode($data)), count($schools));
        return $this->render('simulate', [
            'isCompare' => 1,
            'schools' => $schools,
            'years' => $years,
            'chart' => $chart,
            'chart1' => $chart1,
        ]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        //$arr = is_object($exception) ? get_object_vars($exception) : $exception;
        //echo "<pre>";var_dump($exception);die;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionArticleList($page = 1)
    {
        // var_dump($_GET);die;
        if (empty($_GET['type_id'])) {
            $type_id = '';
        } else {
            $type_id = $_GET['type_id'];
        }
        $title = AdminArticleType::find()
            ->where(['id' =>$type_id])
            ->all();
        $session = Yii::$app->session;
        app()->user->isGuest;
        // $page = is_numeric($page) ? $page : 1;
        if (empty($type_id)) {
        $postParams = app()->request->get();
        $allContent = AdminArticleContent::find()->all();
        $pagination = new Pagination(['totalCount' => count($allContent)]);
        $pageNo = (isset($postParams['page']) && $postParams['page']) > 0 ? $postParams['page'] : 1;
            $articles = AdminArticleContent::find()
                ->where(['status' => '1'])
                ->orderBy('update_date desc')
                ->limit(10)
                ->offset(($pageNo - 1) * 10)
                ->asArray()
                ->all();
        } else {
                $postParams = app()->request->get();
                $allContent = AdminArticleContent::find()
                ->where(['status' => '1', 'type_id' => $type_id])
                ->all();
                $pagination = new Pagination(['totalCount' => count($allContent)]);
                $pageNo = (isset($postParams['page']) && $postParams['page']) > 0 ? $postParams['page'] : 1;
                $articles = AdminArticleContent::find()
                ->where(['status' => '1', 'type_id' => $type_id])
                ->orderBy('update_date desc')
                ->limit(10)
                ->offset(($pageNo - 1) * 10)
                ->asArray()
                ->all();
        }


        $counts = AdminArticleContent::find()
            ->where(['status' => '1'])
            ->count();
        $types = AdminArticleType::find()
            ->select('name, id')
            ->asArray()
            ->all();
        // $pagination = new Pagination(['totalCount' => $counts, 'defaultPageSize' => 10]);
        if (!empty($articles)) {

        } else {
            throw new NotFoundHttpException('找不到文章！');
        }

        //格式化日期
        foreach ($articles as $key => $value) {
            $articles[$key]['update_date'] = date('Y-m-d', strtotime($value['update_date']));
        }
        // dump(i_array_column($types,'name', 'id'));
        return $this->render('article-list', [
            'articles' => $articles,
            'title' => $title[0]['name'],
            'types' => i_array_column($types, 'name', 'id'),
            'pagination' => $pagination,
            'username' => $session['username'],
            'password' => $session['password'],
        ]);
    }

    public function actionFreeList($page = 1)
    {
        $session = Yii::$app->session;
        app()->user->isGuest;
        $page = is_numeric($page) ? $page : 1;
        $counts = AdminSchool::find()
            ->where(['status' => '1'])
            ->count();
        $schools = AdminSchool::getSchools(['status' => '1']);
        $pagination = new Pagination(['totalCount' => $counts, 'defaultPageSize' => 10]);
        if (isset($session['username']) && isset($session['password'])) {
            return $this->renderpartial('free-list', [
                'schools' => $schools,
                'pagination' => $pagination,
                'username' => $session['username'],
                'password' => $session['password'],
            ]);
        } else {
            return $this->renderpartial('free-list', [
                'schools' => $schools,
                'pagination' => $pagination,
            ]);
        }
    }

    /**
     * 异步获取支付信息
     *
     * @param $amount
     * @param $remark
     * @return array
     */
    public function actionGetPayCode($amount, $remark = '')
    {
        app()->response->format = Response::FORMAT_JSON;
        if (!is_numeric($amount) || $amount <= 0) {
            return [
                'data' => [],
                'message' => '金额错误',
                'code' => -1,
            ];
        }
        if (!AdminMember::findOne(app()->user->id)) {
            return [
                'data' => [],
                'message' => '会员不存在',
                'code' => -1,
            ];
        }

        return app()->wxpay->goPay(app()->user->id, $amount, $remark, app()->user->name);
    }

    /**
     * 获取某年的本科分数线
     *
     * @param $year
     * @param $mold
     * @return array
     */
    public function actionGetBatchScore($year, $mold)
    {
        app()->response->format = Response::FORMAT_JSON;
        $scores = AdminBatchScore::find()
            ->select('batch_no,score')
            ->where(['year' => intval($year), 'mold' => intval($mold)])->asArray()->all();
        if(!$scores || count($scores) < 3) {
            $molds = [
                0 => '文科',
                1 => '理科',
                2 => '其他科',
            ];
            return [
                'data' => [],
                'message' => "{$year}年$molds[$mold]分数为空或者不全，请联系管理员",
                'code' => -1,
            ];
        }
        return [
            'data' => array_column($scores, 'score', 'batch_no'),
            'message' => 'success',
            'code' => 0,
        ];
    }

    /**
     * 获取平行志愿的学校
     *
     * @return array
     */
    public function getParallelSchool($data)
    {
        if (!isset($data['mold'], $data['item'], $data['diff_score'], $data['year'])) {
           throw  new InvalidParamException('参数错误');
        }

        if ($data['diff_score'] >= 50) {
            $step = 6;
        } elseif ($data['diff_score'] >=20 && $data['diff_score'] <=49)  {
            $step = 5;
        } elseif ($data['diff_score'] >=0 && $data['diff_score'] <=19) {
            $step = 4;
        }
        $diff_score = $data['diff_score'] + $step;

        $max_diff =  $diff_score - ($data['item'] - 1) * ($step - 1);
        $min_diff = $diff_score - ($data['item']) * ($step - 1);
        $schoolIds = AdminSchoolScore::find()
            ->select('school_id, diff_score')
            ->where(['between', 'diff_score', $min_diff, $max_diff])
            ->orWhere(['diff_score' => 0])
            ->andWhere(['mold_id' => $data['mold']])
            ->andWhere(['year' => $data['year']])
            ->andWhere(['batch_id' => $data['batchIds']])
            ->limit(8)
            ->orderBy('diff_score desc')
            ->indexBy('school_id')
            ->asArray()
            ->all();

        $schools = AdminSchool::find()
            ->select('id, name, mold, batch')
            ->where(['id' => array_column($schoolIds, 'school_id')])->indexBy('id')->asArray()->all();

        foreach ($schools as &$school) {
            $school['diff_score'] = $schoolIds[$school['id']]['diff_score'];
        }

        return $schools;
    }

    /**
     * 查看学校专业分数
     *
     * @param int $schoolId
     * @return array
     */
    public function actionGetProfessionalScore($schoolId)
    {
        app()->response->format = Response::FORMAT_JSON;
        $professionalScore = AdminSchool::find()
            ->select('professional_score')
            ->where(['id' => intval($schoolId)])
            ->asArray()
            ->one();
        if (!$professionalScore['professional_score']) {
            return [
                'data' => [],
                'message' =>"当前学校不存在专业分数",
                'code' => -1,
            ];
        }
        //查看专业录取分数扣钱
        AdminMember::consumeMoney(5, md5($schoolId));
        return [
            'data' => $professionalScore,
            'message' =>"success",
            'code' => 0
        ];
    }

    /**
     * 历年分数线
     */
    public function actionScoreLine()
    {
        $scores = AdminBatchScore::find()->all();
        return $this->render('score_line', [
            'score_line' => $scores,
        ]);
    }

    /**
     * 会员注册
     */
    public function actionCreate()
    {
        $model = new AdminMember();
        $counts = AdminMember::find()
            ->where(['name' => $_POST['username']])
            ->count();
        $prefix_name = AdminUserPrefix::find()
            ->where(['prefix' => $_POST['prefix_name']])
            ->count();

        if ($prefix_name == 0) {
           return json_encode(['code' => 3, 'msg' => '输入前缀不存在！', 'data' => []]);
        }
        if ($counts >= 1) {
                return json_encode(['code' => 2, 'msg' => '该用户名已注册！', 'data' => []]);
        } else {
              $model->create_user = "注册";
              $model->create_date = date('Y-m-d H:i:s');
              $model->update_user = "注册";
              $model->update_date = date('Y-m-d H:i:s');
              $model->name = $_POST['username'];
              $model->password = $_POST['password'];
              $model->status = 10;
              $model->wallet_balance = 50;
              $model->prefix_name = $_POST['prefix_name'];
            if($model->validate() == true && $model->save()){
                return json_encode(['code' => 0, 'msg' => '注册成功！请前往首页进行登录！', 'data' => []]);
            }
            else{
                return json_encode(['code' => 2, 'msg' => '注册失败，请稍后再试！', 'data' => []]);
            }
        }
    }
}
