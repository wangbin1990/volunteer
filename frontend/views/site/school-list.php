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
    '智能填报系统',
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
                    <input name='batch' value="<?= $batch?>" type="hidden">
                    <input name='mold' value="<?= $mold?>" type="hidden">
                    <div class="area fl">
                        <label>地区：</label>
                        <select name="location_id" id="location_id">
                            <option value=0 <?php if($location_id == 0):?>selected=selected<?php endif;?>>请选择</option>
                            <?php foreach($locationCate['children'] as $location):?>
                                <option value="<?= $location['id']?>" <?php if($location_id == $location['id']):?>selected=selected<?php endif;?>><?= $location['name']?></option>
                            <?php endforeach;?>
                        </select>
                        <a onclick="javascript:check_location();">确定</a>
                    </div>
                    <div class="fencha fl">
                        <label>分差：</label>
                        <input type="text" id="low_score" <?php if(isset($params[':low_score'])):?>value="<?= $params[':low_score']?>" <?php endif;?> name="lowScore" placeholder="最低分差">
                        ——
                        <input type="text" id="high_score" <?php if(isset($params[':high_score'])):?>value="<?= $params[':high_score']?>" <?php endif;?> name="highScore" placeholder="最高分差">
                        <!-- <button onclick="$('#searchForm').submit();">确定</button> -->
                        <a onclick="javascript:check_score();">确定</a>
                    </div>
                </form>
                <div class="comparison02-btn fl"><button onclick="chkschool();">院校数据对比</button></div>
                <div class="comparison02-moni fr"><a href="<?= Url::toRoute('site/volunteer-simulation')?>"><button >智能填报系统</button></a></div>
                

                <div class="clearfix"></div>

                <div style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;margin-top:50px;     padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;display: none;" id="dialog">
                    <span id="showData"></span>
                    <span>是否确认？</span>
                    <a href="javascript:$('#searchForm').submit();">确认</a>
                    <a href="javascript:close();">取消</a>
                </div>

                <div style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;margin-top:50px;     padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;display: none;" id="dialog1">
                    <span id="showData1"></span>
                    <span>是否确认？</span>
                    <a href="javascript:$('#submitForm').submit();">确认</a>
                    <a href="javascript:close1();">取消</a>
                </div>
                <div class="doc-content" style="width:100%">
                    <form id="submitForm" action="<?= Url::toRoute('site/compare-school')?>" method="post">
                        <div class="row-fluid show-grid">
                            <div><a onclick="chkall()">全选</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="chkclose()">取消选择</a></div>
                            <hr/>
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
    this.show1(3);
    // $("#submitForm").submit();
    }

  function check_location() {
    var v = document.getElementById("location_id").value;
    if(v == 0) {
      alert("请选择地区！");
      return false;
    } else {
      show(1);
    }
  }

  function check_score() {
    var low_score = document.getElementById("low_score").value;
    var high_score = document.getElementById("high_score").value;
    if(low_score == '' || low_score <= 0 || isNaN(low_score)) {
      alert("最低分请输入合法分数！")
      return false;
    }
    if(high_score == '' || high_score <= 0 || isNaN(high_score)) {
      alert("最高分请输入合法分数！")
      return false;
    }

    if(high_score < low_score) {
      alert("最高分不能低于最低分！")
      return false;
    }

    show(2);

  }
  function chkall(){
      $("input[name='checkSchool[]']").attr("checked","true");
  }

  function chkclose(){
      $("input[name='checkSchool[]']").removeAttr("checked");
  }
  function show(id) {
    $.ajax({
       'url' : '<?= \yii\helpers\Url::toRoute('site/finance')?>',
       'dataType' : 'json',
       'data' : 'id=' + id,
       'type' : 'post',
       'success': function (res) {
         console.log(res);
           if (res.code == 0) {
               //修改页面登录状态
               document.getElementById("showData").innerHTML = "收费版块，该模块将花费："+ res.data + "元";
               document.getElementById("dialog").style.display = "block"
           } else if(res.code == 2) {
               alert(res.msg);
           } else {
               alert(res.msg);
           }
       }
   });
  }

    function show1(id) {
    $.ajax({
       'url' : '<?= \yii\helpers\Url::toRoute('site/finance')?>',
       'dataType' : 'json',
       'data' : 'id=' + id,
       'type' : 'post',
       'success': function (res) {
         console.log(res);
           if (res.code == 0) {
               //修改页面登录状态
               document.getElementById("showData1").innerHTML = "收费版块，该模块将花费："+ res.data + "元/每个学校";
               document.getElementById("dialog1").style.display = "block"
           } else if(res.code == 2) {
               alert(res.msg);
           } else {
               alert(res.msg);
           }
       }
   });
  }

  function close() {
     var ui = document.getElementById("dialog");
     ui.style.display="none";
  }
  function close1() {
     var ui = document.getElementById("dialog1");
     ui.style.display="none";
  }
</script>