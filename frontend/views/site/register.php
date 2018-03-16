<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminMember;
use common\models\AdminUserPrefix;
/* @var $this yii\web\View */

$this->title = '贵州高考志愿咨询数据平台';
$modelLabel = new \backend\models\AdminMember();
$modelPrefixNames = AdminUserPrefix::find()
    ->select('prefix')
    ->asArray()
    ->all();
$modelPrefixNames = array_column($modelPrefixNames, 'prefix');
?>

<!-- header -->

<div id="content">
     <div class="list-banner" style="background-image:url(/frontend/web/images/list-banner.jpg);height:300px" ></div>
     <div class="main">
         <div class="container">
         <div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>添加会员</h3>
      </div>
      <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-member-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-member/save")]); ?>                      
                 <input type="hidden" class="form-control" id="id" name="AdminMember[id]" />

          <div id="name_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="AdminMember[name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="password_div" class="form-group">
              <label for="password" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("password")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="password" name="AdminMember[password]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="last_ip_div" class="form-group">
              <label for="last_ip" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("last_ip")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="last_ip" name="AdminMember[last_ip]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>


          <div id="wallet_balance_div" class="form-group">
              <label for="wallet_balance" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("wallet_balance")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="wallet_balance" name="AdminMember[wallet_balance]" placeholder=""   />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="status_div" class="form-group">
              <label for="status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="status" name="AdminMember[status]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>
          <div id="status_div" class="form-group">
              <label for="prefix_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("prefix_name")?></label>
              <div class="col-sm-10">
                  <select id="prefix_name" class="form-control" name="AdminMember[prefix_name]">
                      <option value="">请选择：</option>
                      <?php foreach ($modelPrefixNames as $prefixName):?>
                          <option value="<?=$prefixName ?>"><?=$prefixName ?></option>
                      <?php endforeach;?>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_user_div" class="form-group">
              <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_user" name="AdminMember[create_user]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_date" name="AdminMember[create_date]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_user_div" class="form-group">
              <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_user" name="AdminMember[update_user]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_date_div" class="form-group">
              <label for="update_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_date" name="AdminMember[update_date]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>
                    

      <?php ActiveForm::end(); ?>          
                </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
          id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
      </div>
    </div>
  </div>
</div>
              
          <div class="clearfix"></div>
                </div>
         </div>

     </div>
</div>