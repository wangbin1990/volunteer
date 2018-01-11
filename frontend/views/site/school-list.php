<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->params['breadcrumbs'] =[
    [
      'label' => '筛选学校',
      'url' => ['site/lsucc'],
    ],
    '  志愿模拟',
]
?>

<!-- header -->
<?php include 'header.php';?>
<!-- content -->
<div id="content">
    <div class="container">
        <div class="wrapper">
            <div class="mainContent" style="width: auto;">
          <div class="row">
    <div class="span24 doc-content">
        <div class="row show-grid" style="background:#13140D1A;">
          <div class="span8" style="width: 118px;padding-top: 6px;padding-left: 6px;">
            <span  style="font-size: 28px;line-height: 1.2em;color: #000;font-weight: 600;"><?= $batchName?></span>
          </div>
          <form id ="searchForm" action=""  method="post">
          <div class="span8" style="width: 460px;margin-top:9px">
            <label>
            地区：
            </label>
            <select name="location_id">
                <option value=0 <?php if($location_id == 0):?>selected=selected<?php endif;?>>请选择</option>
                <?php foreach($locationCate['children'] as $location):?>
                    <option value="<?= $location['id']?>" <?php if($location_id == $location['id']):?>selected=selected<?php endif;?>><?= $location['name']?></option>
                <?php endforeach;?>
            </select>
             <label>
            学校：
            </label>
            <input type="text" name="school" value="<?php if(isset($params['school'])):?><?= $params['school']?> <?php endif;?>" placeholder="学校名称" class="text">
			     <br>
            <label class="control-label" style="padding-top: 8px;">
            分差：
            </label>
            <input type="text" <?php if(isset($params[':low_score'])):?>value="<?= $params[':low_score']?>" <?php endif;?> name="lowScore" placeholder="最低分差" class="text" style="margin-top: 2px;margin-bottom:5px;width:56px"/>--
            <input type="text" <?php if(isset($params[':high_score'])):?>value="<?= $params[':high_score']?>" <?php endif;?> name="highScore" placeholder="最高分差" class="text" style="margin-top: 2px;margin-bottom:5px;width:56px;"/>
			
          </div>
          <div class="span8" style="width: 160px;padding-left:32px;">
              <div class="controls" style="padding-top: 4px;height: 42px;">
                  <button class="button button-mini button-primary" style="width: 127px;height: 37px;padding: 1px 5px;font-size: 14px;border-radius: 8px;" onclick="$('#searchForm').submit()";">筛选</button>
              </div>
          </div>
          </form>
<!--           <div class="span8" style="width: 245px;">
            <label class="control-label" style="float: left;text-align: right;line-height: 30px;display: inline-block;*display: inline;*zoom: 1;width: 55px;font-size: 18px;padding-top: 8px;">排位：</label>
            <div class="controls" style="padding-top: 7px;">
            <select class="input-normal">
                <option value="saler">5</option>
                <option value="large">10</option>
            </select>
            </div>
          </div> -->

          <div class="span8" style="width: 140px;">
            <div class="controls" style="padding-top: 4px;height: 42px;">
                <button class="button button-mini button-primary" style="width: 127px;height: 37px;padding: 1px 5px;font-size: 14px;border-radius: 8px;" onclick="chkschool();">志愿模拟</button>
            </div>
          </div>
        </div>
    </div>
  </div>
    <div style="margin-top: 22px;">
      <div class="row clearfix">
    <div class="col-md-12 column" style="margin-left:20px">
       <button type="button" class="btn btn-default btn-success" onclick="chkall();">全选</button>
       <button type="button" class="btn btn-default" onclick="chkclose();">取消全选</button>
    </div>
  </div>
    </div>
  <hr style="margin-top: 3px;" />
  <div class="doc-content" style="width:100%">
  <form id="submitForm" action="<?= Url::to('simulate')?>" method="post">
      <div class="row-fluid show-grid">
      <input name='batch' value=<?= $batch?> type="hidden">
      <input name='mold' value=<?= $mold?> type="hidden">
      	<?php if(!empty($schools)):?>
    		<?php foreach ($schools as $school):?>
    			    <div class="span2" style="width: 50%;font-size: 18px;margin: 0 auto;"><input name="school[]" type="checkbox" value="<?= $school['id']?>" id="<?= $school['id']?>"/><label for="<?= $school['id']?>"><a href="<?= Url::to('school-' . $school['id'])?>" target="_blank"><?= $school['name']?></a></label></div>
    	    <?php endforeach;?>
        <?php endif;?>
      </div>
  </form>
  </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
  function chkschool(){ //jquery获取复选框值
    var chk_value =[];
    $('input[name="school[]"]:checked').each(function(){
        chk_value.push($(this).val());
    });
    if (chk_value.length == 0) {
    	alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
    	return false;
    }
    $("#submitForm").submit();
    }
  function chkall(){
      $("input[name='school[]']").attr("checked","true");
  }

  function chkclose(){
      $("input[name='school[]']").removeAttr("checked");
  }
</script>