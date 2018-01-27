<?php

namespace backend\controllers;

use backend\models\AdminMember;
use Yii;
use yii\data\Pagination;
use common\models\AdminFinanceRecord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * AdminFinanceRecordController implements the CRUD actions for AdminFinanceRecord model.
 */
class AdminFinanceRecordController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all AdminFinanceRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminFinanceRecord::find();
        $querys = Yii::$app->request->get('query');

        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
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
        }
        $startDate = app()->request->get('startDate', 0);
        $endDate = app()->request->get('endDate', 0);
        if ($startDate && $endDate && $startDate > $endDate) {
            $tmp = $startDate;
            $startDate = $endDate;
            $endDate = $tmp;
        }

        if ($startDate) {
            $querys['startDate']=$startDate;
            $query->andWhere(['>=' ,'create_time', strtotime($startDate)]);
        }
        if ($endDate) {
            $querys['endDate']=$endDate;
            $query->andWhere(['<=', 'create_time', strtotime($endDate)]);
        }

        if ($prefixName = app()->request->get('prefix_name', 0)) {
            $querys['prefix_name'] = $prefixName;
            $memberIds  = AdminMember::find()->select('id')->where(['like', 'prefix_name', $prefixName])->asArray()->all();
            if ($memberIds) {
                $query->andWhere(['in', 'member_id', array_column($memberIds, 'id')]);
            } else {
                $query->andWhere('1=0');
            }
        }
        if ($memberName = app()->request->get('member_name', 0)) {
            $querys['member_name'] = $memberName;
            $memberIds  = AdminMember::find()->select('id')->where(['like', 'name', $memberName])->asArray()->all();
            if ($memberIds) {
                $query->andWhere(['in', 'member_id', array_column($memberIds, 'id')]);
            } else {
                $query->andWhere('1=0');
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
        foreach ($models as $model) {
            $model->create_time = date("Y-m-d H:i:s", $model->create_time);
            $model->operate_type = $model->operate_type==2 ? '消费' : '充值';
        }

        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single AdminFinanceRecord model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new AdminFinanceRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminFinanceRecord();
        if ($model->load(Yii::$app->request->post())) {
            $model->ip = app()->request->userIP;
            $model->operate_name = app()->user->uname;
            if ($model->operate_type != 2) {
                return ['errno' => 2, 'msg' => '后台只能消费操作'];
            }

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
     * Updates an existing AdminFinanceRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        return false;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
              $model->amount = '0.00';
        
        
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
     * Deletes an existing AdminFinanceRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = AdminFinanceRecord::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the AdminFinanceRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminFinanceRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminFinanceRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 异步获取支付信息
     *
     * @param $memberId
     * @param $amount
     * @param $remark
     * @return array
     */
    public function actionGetPayCode($memberId, $amount, $remark = '')
   {
        app()->response->format = Response::FORMAT_JSON;
        if (!is_numeric($memberId) || !is_numeric($amount) || $amount <= 0) {
            return [
                'data' => [],
                'message' => '会员ID或金额错误',
                'code' => -1,
            ];
        }
        if (!AdminMember::findOne($memberId)) {
            return [
                'data' => [],
                'message' => '会员不存在',
                'code' => -1,
            ];
        }

        return app()->wxpay->goPay($memberId, $amount, $remark);
    }
}
