<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\AdminSchoolScore;
use common\models\AdminSchool;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * AdminSchoolScoreController implements the CRUD actions for AdminSchoolScore model.
 */
class AdminSchoolScoreController extends BaseController
{
	public $layout = "lte_main";
	public $enableCsrfValidation = false;

    /**
     * Lists all AdminSchoolScore models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminSchoolScore::find();
         $querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
            if (!empty($querys['school_name'])) {
                $schoolArr = AdminSchool::find()
                    ->select('id')
                    ->where(['like', 'name', Html::encode($querys['school_name'])])
                    ->asArray()
                    ->all();
                if (!empty($schoolArr)) {
                    $querys['school_id'] = i_array_column($schoolArr, 'id');
                }
            }
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                if ($key == 'school_name' || $key == 'school_id') {
                    continue;
                }
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]=$value;
                    if(empty($condition) == true){
                        $condition = " {$key}=:{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
            if (!empty($querys['school_id'])) {
                $query->andWhere(['in', 'school_id', $querys['school_id']]);
            }
        }

        $pagination = new Pagination([
            'totalCount' =>$query->count(),
            'pageSize' => '10',
            'pageParam'=>'page',
            'pageSizeParam'=>'per-page']
        );

        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby) == false){
            $query = $query->orderBy($orderby);
        }


        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        $ids = [];

        $schoolInfo = AdminSchool::find()
            ->select('name,id')
            ->asArray()
            ->all();

        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'schoolInfo' => $schoolInfo,
        ]);
    }

    /**
     * Displays a single AdminSchoolScore model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new AdminSchoolScore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminSchoolScore();
        if ($model->load(Yii::$app->request->post())) {

            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    /**
     * Updates an existing AdminSchoolScore model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {



            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }

    }

    /**
     * Deletes an existing AdminSchoolScore model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = AdminSchoolScore::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }


    }

    /**
     * Finds the AdminSchoolScore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminSchoolScore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminSchoolScore::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
