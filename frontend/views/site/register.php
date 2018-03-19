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

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>注册会员</h3>
      </div>
      <div class="modal-body">                    
          <div id="name_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="register_username" name="userName" placeholder="注册帐号" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="password_div" class="form-group">
              <label for="password" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("password")?></label>
              <div class="col-sm-10">
                  <input type="password" class="form-control" id="register_password" name="password" placeholder="注册密码" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="password_div" class="form-group">
              <label for="password" class="col-sm-2 control-label">确认密码</label>
              <div class="col-sm-10">
                  <input type="password" class="form-control" id="register_password1" name="password1" placeholder="确认密码" />
              </div>
              <div class="clearfix"></div>
          </div>

          <input type="hidden" class="form-control" id="wallet_balance" name="wallet_balance" placeholder="" value="50"  />

          <input type="hidden" class="form-control" id="status" name="status" placeholder="必填" value="10" />

          <div id="password_div" class="form-group">
              <label for="prefix_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("prefix_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="prefix_name" name="prefix_name" placeholder="请输入前缀" />
              </div>
              <div class="clearfix"></div>
          </div>
<!--           <div id="status_div" class="form-group">
              <label for="prefix_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("prefix_name")?></label>
              <div class="col-sm-10">
                  <select id="prefix_name" class="form-control" name="prefix_name">
                      <option value="">请选择：</option>
                      <?php foreach ($modelPrefixNames as $prefixName):?>
                          <option value="<?=$prefixName ?>"><?=$prefixName ?></option>
                      <?php endforeach;?>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div> -->
                          
                </div>
      <div class="modal-footer">
         <a id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
      </div>
  </div>
</div>
              
          <div class="clearfix"></div>
                </div>
         </div>

     </div>
</div>

<script type="text/javascript">
$('#edit_dialog_ok').click(function (e) {
    var userName= $("#register_username").val();
    var password= $("#register_password").val();
    var prefix_name = $("#prefix_name").val();
    var password1= $("#register_password1").val();
    if(password === password1) {
              if (userName && password && prefix_name) {
            $.ajax({
                'url' : '<?= \yii\helpers\Url::toRoute('site/create')?>',
                'dataType' : 'json',
                'data' : 'username=' + userName + '&password=' + password + '&prefix_name=' + prefix_name,
                'type' : 'post',
                'success': function (res) {
                  console.log(res);
                    if (res.code == 0) {
                        //修改页面登录状态
                        alert(res.msg);
                        window.location.href = '/frontend/web';
                    } else if(res.code == 2) {
                        alert(res.msg);
                    } else {
                        alert(res.msg);
                    }
                }
            });
        } else {
            alert('帐号、密码、前缀不能为空！');
            return false;
        }
    } else {
            alert('两次输入的密码不同！');
            return false;
    }
});
</script>