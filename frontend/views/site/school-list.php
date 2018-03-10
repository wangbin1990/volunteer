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
<!-- content -->


<div id="content">
    <div class="list-banner"><img src="<?= Url::to("@web/images/list-banner.jpg")?>" alt=""></div>
    <div class="main">
        <div class="container">
            <h3>选择学校</h3>
            <div class="list-comparison comparison02">
                <form id ="searchForm" action=""  method="get">
                    <div class="area fl">
                        <label>地区：</label>
                        <select name="location_id">
                            <option value=0 <?php if($location_id == 0):?>selected=selected<?php endif;?>>请选择</option>
                            <?php foreach($locationCate['children'] as $location):?>
                                <option value="<?= $location['id']?>" <?php if($location_id == $location['id']):?>selected=selected<?php endif;?>><?= $location['name']?></option>
                            <?php endforeach;?>
                        </select>
                        <button onclick="$('#searchForm').submit()";">确定</button>
                    </div>
                    <div class="fencha fl">
                        <label>分差：</label>
                        <input type="text" <?php if(isset($params[':low_score'])):?>value="<?= $params[':low_score']?>" <?php endif;?> name="lowScore" placeholder="最低分差">
                        ——
                        <input type="text" <?php if(isset($params[':high_score'])):?>value="<?= $params[':high_score']?>" <?php endif;?> name="highScore" placeholder="最高分差">
                        <button onclick="$('#searchForm').submit()";">确定</button>
                    </div>
                </form>
                <div class="comparison02-btn fl"><button onclick="chkschool();">院校数据对比</button></div>
                <div class="comparison02-moni fr"><a href="<?= Url::toRoute('site/volunteer-simulation')?>"><button >志愿模拟</button></a></div>
                <div class="clearfix"></div>

                <div class="doc-content" style="width:100%">
                    <form id="submitForm" action="<?= Url::toRoute('site/compare-school')?>" method="post">
                        <div class="row-fluid show-grid">
                            <input name='batch' value="<?= $batch?>" type="hidden">
                            <input name='mold' value="<?= $mold?>" type="hidden">
                            <?php if(!empty($schools)):?>
                                <?php foreach ($schools as $school):?>
                                <div class="span2" style="width: 50%;font-size: 18px;margin: 0 auto;">
                                    <input name="checkSchool[]" type="checkbox" value="<?= $school['id']?>" id="<?= $school['id']?>">
                                    <label for="50">
                                        <a href="<?= Url::to('school-' . $school['id'])?>" target="_blank"><?= $school['name']?></a>
                                    </label>
                                </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>

            </div>
        <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
        </div>
    </div>
</div>


<script type="text/javascript">
  function chkschool(){ //jquery获取复选框值
    var chk_value =[];
    $('input[name="checkSchool[]"]:checked').each(function(){
        chk_value.push($(this).val());
    });
    if (chk_value.length == 0) {
    	alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
    	return false;
    }
    $("#submitForm").submit();
    }
  function chkall(){
      $("input[name='checkSchool[]']").attr("checked","true");
  }

  function chkclose(){
      $("input[name='checkSchool[]']").removeAttr("checked");
  }
</script>