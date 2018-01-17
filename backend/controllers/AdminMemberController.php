<?php
namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\AdminMember;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
/**
 * Site controller
 */
class AdminMemberController extends BaseController
{
    public $layout = "lte_main";

    public function actionIndex()
    {
        $query = AdminMember::find();
        $querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]='%'.$value.'%';
                    if(empty($condition) == true){
                        $condition = " {$key} LIKE :{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key} LIKE :{$key} ";
                    }
                }
            }
            var_dump($condition,$parame);
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
        }


        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '50', 
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
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    public function actionView($id)
    {
        //$id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    public function actionCreate()
    {
        $model = new AdminMember();
        if ($model->load(Yii::$app->request->post())) {
              //$model->password = Yii::$app->security->generatePasswordHash($model->password);
              $model->create_user = Yii::$app->user->identity->uname;
              $model->create_date = date('Y-m-d H:i:s');
              $model->update_user = Yii::$app->user->identity->uname;
              $model->update_date = date('Y-m-d H:i:s');
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

    public function actionAdds()
    {
        $model = new AdminMember();
        // $data = $model->load(Yii::$app->request->post());
        if(!empty($_POST)){
        //$paw = Yii::$app->security->generatePasswordHash($_POST['AdminMember']['password']);
        $num = $_POST['AdminMember']['num'];//账号权限
        $number = $_POST['AdminMember']['status'];//生成账号的个数
        $create_user = Yii::$app->user->identity->uname;
        $create_date = date('Y-m-d H:i:s');
        $update_user = Yii::$app->user->identity->uname;
        $update_date = date('Y-m-d H:i:s');
        $keys = ['name','password','num','status','create_user','create_date','update_user','update_date']; 
        for ($i=0; $i < intval($number); $i++) { 
            // var_dump($i);
            $paw = rand(10000000,99999999);
            $rname = intval($_POST['AdminMember']['name'])+rand(100000,999999);
            $name = $_POST['AdminMember']['name'].$rname;
            $data[] = [$name,$paw,$num,10,$create_user,$create_date,$update_user,$update_date];
        }
        $result = Yii::$app->db->createCommand()->batchInsert('admin_member',$keys,$data)->execute();
        if($result){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        }else{
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg); 
        }

    }


    /**
     * Updates an existing AdminRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
			  //$model->password = Yii::$app->security->generatePasswordHash($_POST['AdminMember']['password']);
              $model->update_user = Yii::$app->user->identity->uname;
              $model->update_date = date('Y-m-d H:i:s');        
        
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

    protected function findModel($id)
    {
        if (($model = AdminMember::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Deletes an existing AdminRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = AdminMember::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }
}
