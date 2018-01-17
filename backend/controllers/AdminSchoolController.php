<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\AdminSchool;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use common\models\AdminSchoolScore;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\UrlManager;

/**
 * AdminSchoolController implements the CRUD actions for AdminSchool model.
 */
class AdminSchoolController extends BaseController
{
	public $layout = "lte_main";
    public $enableCsrfValidation = false ;

    /**
     * Lists all AdminSchool models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminSchool::find();
         $querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            $name = 0;
            foreach($querys as $key=>$value){
                $value = trim($value);
                if ($key == 'mold') {
                    if($value > -1) {
                        $condition[$key] = $value;
                    }
                    continue;
                }
                if (!empty($value)) {
                    if ($key == 'name') {
                        $name = $value;
                    } else {
                        $condition[$key] = $value;
                    }
                }

            }
            if(count($condition) > 0){
                $query = $query->where($condition);
            }
            if(!empty($name)){
                $query = $query->andWhere(['like', 'name', $name]);
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
		$obj = new AdminSchool();
		$cates = $obj->getCates();
		$models = $obj-> changeMoldeInfo($models);

        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
			'cates' => $cates,
        ]);
    }

    /**
     * Displays a single AdminSchool model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new AdminSchool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminSchool();
        $data = Yii::$app->request->post();
        $data['AdminSchool']['create_time'] = date('Y-m-d H:i:s', time());
        if ($model->load($data)) {
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
     * Updates an existing AdminSchool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if (!empty($data['AdminSchool']['spec'])) {
            $data['AdminSchool']['spec']  = implode(',', $data['AdminSchool']['spec']);
        }
        $data['AdminSchool']['update_time'] = date('Y-m-d H:i:s', time());

        if ($model->load($data)) {
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
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        }

    }

    /**
     * Deletes an existing AdminSchool model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = AdminSchool::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }


    }

    public function actionAddScore()
    {
        $data = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty(array_filter($data['year']))) {
            $score = [];

            foreach($data['year'] as $key => $item) {
                $score[$key ]['year'] = $item;
                $score[$key ]['school_id'] = $data['school_id'];
                $score[$key ]['low_score'] = !empty($data['low_score'][$key]) ? $data['low_score'][$key] : 0;
                $score[$key ]['high_score'] = !empty($data['high_score'][$key]) ? $data['high_score'][$key] : 0;;
                $score[$key ]['agv_score'] = !empty($data['agv_score'][$key]) ? $data['agv_score'][$key] : 0;;
                $score[$key ]['diff_score'] = !empty($data['diff_score'][$key]) ? $data['diff_score'][$key] : 0;
                $score[$key ]['plan_count'] = !empty($data['plan_count'][$key]) ? $data['plan_count'][$key] : 0;
                $score[$key ]['rank'] = !empty($data['rank'][$key]) ? $data['rank'][$key ] : 0;
                $score[$key ]['batch_id'] = $data['batch_id'][$key];
                $score[$key ]['mold_id'] = $data['mold_id'][$key];
                $score[$key ]['number'] = !empty($data['number'][$key]) ? $data['number'][$key] : 0;
            }
            if (!empty($data['id'])) {
                $num = 0;
                foreach($score as $ke => $val) {

                    $num += AdminSchoolScore::updateAll($val, ['id' => $data['id'][$ke]]);
                }
                return ['errno' => 0, 'message' => $num . '数据更新成功！'];
            }
            $num = Yii::$app->db->createCommand()->batchInsert(
                'admin_school_score',
                ['year','school_id', 'low_score', 'high_score', 'agv_score', 'diff_score', 'plan_count', 'rank', 'batch_id', 'mold_id','number'],
                $score
            )->execute();
            return ['errno' => 0, 'message' => $num . '数据插入成功！'];
        }
        return ['errno' => -1, 'message' => '年份必填'];
	}

    public function actionEditScore()
    {
        $data = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty(array_filter($data['year']))) {
            $score = [];
            foreach($data['year'] as $key => $item) {
                $score[$key ]['year'] = $item;
                $score[$key ]['school_id'] = $data['id'];
                $score[$key ]['low_score'] = !empty($data['low_score'][$key]) ? $data['low_score'][$key] : 0;
                $score[$key ]['high_score'] = !empty($data['high_score'][$key]) ? $data['high_score'][$key] : 0;;
                $score[$key ]['agv_score'] = !empty($data['agv_score'][$key]) ? $data['agv_score'][$key] : 0;;
                $score[$key ]['diff_score'] = !empty($data['diff_score'][$key]) ? $data['diff_score'][$key] : 0;
                $score[$key ]['plan_count'] = !empty($data['plan_count'][$key]) ? $data['plan_count'][$key] : 0;
                $score[$key ]['rank'] = !empty($data['rank'][$key]) ? $data['rank'][$key ] : 0;
                $score[$key ]['batch_id'] = $data['batch_id'][$key];
                $score[$key ]['mold_id'] = $data['mold_id'][$key];
                $score[$key ]['number'] = !empty($data['number'][$key]) ? $data['number'][$key] : 0;
            }
            
            return ['errno' => 0, 'message' => $num . '数据插入成功！'];
        }
        return ['errno' => -1, 'message' => '年份必填'];
	}

    public function actionViewScore($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $scores= AdminSchool::getScores($id);

        return $scores;
    }

     public function actionUpdateScore($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $scores= AdminSchoolScore::find()
            ->where(['school_id' => $id])
            ->asArray()
            ->all();
       return $scores;
    }

    /**
     *
     */
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $image = UploadedFile::getInstanceByName('upload');

            $basePath = Yii::$app->basePath . '/web/uploadImages';
            $fileName = "/" . time() .'.' . $image->extension;
            if ($image->saveAs($basePath . $fileName)) {
                $imageurl = app()->params['imgUrl']() . $fileName;
                return "<script type=\"text/javascript\">
                    window.parent.CKEDITOR.tools.callFunction(1,'" . $imageurl . "');</script>";
            }
        }
        return false;
    }

    /**
     * Finds the AdminSchool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminSchool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminSchool::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
