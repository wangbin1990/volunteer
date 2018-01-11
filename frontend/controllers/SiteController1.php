<?php
namespace frontend\controllers;

use Yii;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AdminSchool;
use common\models\AdminSchoolScore;
use yii\web\NotFoundHttpException;
use backend\models\AdminMember;
use backend\models\AdminArticleContent;
use backend\models\AdminArticleType;
use common\utils\CommonFun;
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
                    'lsucc',
                    'school-list',
                    'simulate',
                ],
                'rules' => [
                    [
                        'actions' => [
                            'logout',
                            'lsucc',
                            'school-list',
                            'simulate',
                        ],
                        'allow' => true,
                        'roles' => [
                            '@'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => [
                        'post'
                    ]
                ]
            ]
        ];
    }


    /**
     * 志愿系统首页
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;app()->user->isGuest;
        $schools = AdminSchool::getSchools(['status' => '1'], 7);
        //关于志愿
        $content_a = AdminArticleContent::getArticleContent(['type_id' => '207','status' => '1'],7);
        //历届高考咨询
        $content_b = AdminArticleContent::getArticleContent(['type_id' => '208','status' => '1'],7);
        //关于我们
        $content_c = AdminArticleContent::getArticleContent(['type_id' => '209','status' => '1'],7);
        //最新公告
        $content_d = AdminArticleContent::getArticleContent(['type_id' => '210','status' => '1'],7);
		//靠前准备
		$content_e = AdminArticleContent::getArticleContent(['type_id' => '211','status' => '1'],7);
		
		foreach ($content_a as $key => $value) {
            $content_a[$key]['create_date'] = date('Y-m-d',strtotime($value['create_date']));
        }
		foreach ($content_b as $key => $value) {
            $content_b[$key]['create_date'] = date('Y-m-d',strtotime($value['create_date']));
        }
        foreach ($content_d as $key => $value) {
            $content_d[$key]['create_date'] = date('Y-m-d',strtotime($value['create_date']));
        }
        if(isset($session['username']) && isset($session['password'])) {
            return $this->renderpartial('index', [
            'schools' => $schools,
            'content_a' => $content_a,
            'content_b' => $content_b,
            'content_c' => $content_c,
            'content_d' => $content_d,
			'content_e' => $content_e,
            'username' => $session['username'],
            'password' => $session['password'],
        ]);
        } else {
            return $this->renderpartial('index',[
            'schools' => $schools,
            'content_a' => $content_a,
            'content_b' => $content_b,
            'content_c' => $content_c,
            'content_d' => $content_d,
			'content_e' => $content_e,
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
                if (app()->user->isGuest) {
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
                                $adminMember->num = $num -1;
                                $adminMember->update_date = date('Y-m-d H:i:s', time());
                                $adminMember->update();

                            }
                        } else {
                            throw new InvalidParamException('查看权限次数已用完');
                        }
                    }
                }

            }
        }else {
            throw new NotFoundHttpException('找不到当前的学校');
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
        $content = AdminArticleContent::getArticleContent(['id' => $id,'status' => '1']);
         return $this->render('article',[
            'content' => $content,
            ]);
    }

    /**
     * 登录后，跳转
     *
     */
    public function actionLoginSucc()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $rememberMe = Yii::$app->request->post('remember');
        $rememberMe = $rememberMe == 'y' ? true : false;
        $session = Yii::$app->session;
        if(isset($session['username']) && isset($session['password'])) {
            if($session['username'] == $username && $session['password'] == $password){
                echo json_encode([
                    'username' => $session['username'],
                    'password' => $session['password'],
                    'errno' => 1,
                ]);
            }else{
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                echo json_encode([
                    'errno' => 0,
                ]);
            }

        } else {
           if (AdminMember::login_new($username, $password, $rememberMe) == true) {
            AdminMember::updateAll([
                'last_ip' => CommonFun::getClientIp()
            ], [
                'name' => $username
            ]);
            // return $this->goBack();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            echo json_encode([
                'errno' => 0,
            ]);

        } else {
            echo json_encode([
                'errno' => 2
            ]);
        }
        }

    }

    public function actionExit()
    {
       app()->user->logout();
       return $this->goHome();
    }

    public function actionLsucc()
    {
        $session = Yii::$app->session;
        if (!app()->user->isGuest) {
            $schoolObj = new AdminSchool();
            $cate = $schoolObj->getCateByName($schoolObj->getRelitaveName('batch'));
            $mold = $schoolObj->getMold();
            if (empty($cate) || empty($mold)) {
                app()->session->setFlash('warning', '没有可筛选的学校');
            }
            //dump($cate);
            return $this->render('login-succ',[
                'cate' => $cate,
                'mold' => $mold,
            ]);
        } else {
            echo "<h1><a href='index'>非法访问，请前往首页登录！</a></h1>";
        }
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
    public function actionSchoolList($batch = null, $mold = null)
    {
        $conditions = [];
        $params = [];
        $location_id = 0;
        if (isset($batch)) {
            $conditions[':batch'] = intval($batch);
        }
        if (isset($mold)) {
            $mold= intval($mold);
            $conditions[':mold'] = "{$mold}";
        }
        $postParams = app()->request->post();
        if (isset($postParams['location_id']) && $postParams['location_id'] > 0) {
             $location_id = $conditions[':location_id'] = intval($postParams['location_id']);
        }

        if (isset($postParams['school'])) {
            $conditions['school'] = \yii\helpers\Html::encode(trim($postParams['school']));
        }

        if (isset($postParams['highScore']) && $postParams['highScore'] > 0) {
             $params[':high_score'] = intval($postParams['highScore']);
        }
        if (isset($postParams['lowScore']) && $postParams['highScore'] > 0) {
             $params[':low_score'] = intval($postParams['lowScore']);
        }
        if (isset($params[':high_score'])
            && isset($params[':lowScore'])
            && $params[':high_score'] < $params[':lowScore']) {
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
        $schools = AdminSchool::getSchoolsByDiffScore($conditions, $params);
        if (empty($schools)) {
            app()->session->setFlash('warning','没有搜索到的学校');
        }//dump($cate);

        $params['school'] = isset($conditions['school']) ? $conditions['school'] : '';
        return $this->render('School-list', [
            'schools' => $schools,
            'cate' => $cate,
            'params' => $params,
            'batch' => $batch,
            'mold' => $mold,
            'batchName' => $batchName,
            'locationCate' => $locationCate,
            'location_id' => $location_id,
        ]);
    }

    /**
     * 模拟志愿
     */
        public function actionSimulate()
    {
        $data = app()->request->post();
        if (empty($data['school'])) {
            app()->session->setFlash('error','没有选择模拟的学校');
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
                        $chart2[$key]['data'][$score['year']]= $score['diff_score'];
                    }
                    //$chart[$key]['data'] = array_column($school['scores'], 'diff_score');
                    $years = array_merge(i_array_column($school['scores'], 'year'), $years);
                }
                $years = array_unique($years);
                sort($years);
                $chart1 = $chart;
             
                foreach ($years  as $year) {
                    foreach ($chart1 as $k => &$value) {
                        if (!in_array($year, array_keys($value['data']))) {
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
        return $this->render('simulate',[
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
        }else{
            $type_id = $_GET['type_id'];
        }
        $session = Yii::$app->session;app()->user->isGuest;
        $page = is_numeric($page) ? $page : 1;
        if (empty($type_id)) {
            $articles = AdminArticleContent::find()
            ->where(['status' => '1'])
            ->orderBy('sort desc')
            ->limit(10)
            ->offset(($page-1) * 10)
            ->asArray()
            ->all();
        }else{
            $articles = AdminArticleContent::find()
            ->where(['status' => '1','type_id' => $type_id])
            ->orderBy('sort desc')
            ->limit(10)
            ->offset(($page-1) * 10)
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
        $pagination = new Pagination(['totalCount' => $counts, 'defaultPageSize' => 10]);
        if (!empty($articles)) {

        } else {
            throw new NotFoundHttpException('找不到文章！');
        }
        
        //格式化日期
        foreach ($articles as $key => $value) {
            $articles[$key]['create_date'] = date('Y-m-d',strtotime($value['create_date']));
        }
        //dump(i_array_column($types,'name', 'id'));
        return $this->renderpartial('article-list', [
            'articles' => $articles,
            'types' => i_array_column($types,'name', 'id'),
            'pagination' => $pagination,
            'username' => $session['username'],
            'password' => $session['password'],
        ]);
    }

    public function actionFreeList($page = 1)
    {
        $session = Yii::$app->session;app()->user->isGuest;
        $page = is_numeric($page) ? $page : 1;
        $counts = AdminSchool::find()
            ->where(['status' => '1'])
            ->count();
        $schools = AdminSchool::getSchools(['status' => '1']);
        $pagination = new Pagination(['totalCount' => $counts, 'defaultPageSize' => 10]);
        if(isset($session['username']) && isset($session['password'])) {
            return $this->renderpartial('free-list', [
            'schools' => $schools,
            'pagination' => $pagination,
            'username' => $session['username'],
            'password' => $session['password'],
        ]);
        } else {
            return $this->renderpartial('free-list',[
            'schools' => $schools,
            'pagination' => $pagination,
            ]);
        }
    }
}
