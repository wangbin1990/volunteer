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
 * Api controller
 */
class ApiController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionWxpayNotify()
    {
        return app()->wxpay->notify();
    }
}
