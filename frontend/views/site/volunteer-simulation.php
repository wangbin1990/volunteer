<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '贵州高考志愿咨询数据平台';
$years = \common\models\AdminBatchScore::find()
    ->select('year')
    ->distinct('year')
    ->asArray()
    ->orderBy('year desc')
    ->all();
$years = array_column($years, 'year');

?>
<!-- header -->
<div class="clear"></div>
<div id="content">
     <div class="list-banner"><img src="/frontend/web/images/list-banner.jpg" alt=""></div>
     <div class="main">
         <div class="container">
               <h3>志愿模拟</h3>
               <div class="main-moni">
                   <form id="form" action="<?= Url::toRoute('site/select-school')?>" method="post" target="_blank">
                       <input name = "yiben" id="yiben" value="1" type="hidden">
                   <ul>
                       <li><span>年份：</span>
                           <select id="year" name="year">
                            <?php foreach ($years as $year):?>
                                <option value ="<?= $year?>"><?= $year?></option>
                            <?php endforeach;?>
                           </select>
                        </li>
                         <li><span>考分：</span><input type="text" placeholder="考生考分" name="grade" id="grade"></li>
                       <li><span>文理：</span>
                           <select name="mold" id="mold">
                               <option value ="0" >文</option>
                               <option value ="1">理</option>
                               <option value ="2">其他</option>
                           </select>
                       </li>
                       <li><span>排位：</span><input type="text"  name = "sort" placeholder="考生所在省份的排名"></li>
                       <div class="clearfix"></div>
                   </ul>
                   <div class="btn-box"><input type="button" class="btn"  value="提 交" onclick="show1(4);"></div>
                <div style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;margin-top:50px;     padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;display: none;" id="dialog1">
                    <span id="showData1"></span>
                    <span>是否确认？</span>
                    <a class="submit01">确认</a>
                    <a href="javascript:close1();">取消</a>
                </div>
                   <div class="fencha-box">
                       <div class="fenccha-nei">
                            <div class="text">
                             <p id="msg"></p>
                             <input type="hidden" value="40" id="diff_score" name="diff_score">
                             <h1 id="diff_grade"> 分</h1>
                            <p id="msg1" style="margin-top:5px;"></p>
                            <input type="hidden" value="40" id="diff_score1" name="diff_score1">
                            <div class="batch_2" style="display: none;">
                             <input type="text"  name="batch_2" placeholder="二本数">
                             <input  type="text" name="batch_3" placeholder="老三本数">
                            </div>
                            <div class="btn-box"><button type="submit" class="btn submit02" onclick="$('#yiben').val(1);$('#form').submit();">确定</button></a></div>
                                <div id="sb" style="display: none">
                                <p id="msg2"></p>
                                <input type="hidden" value="40" id="diff_score2" name="diff_score2">
                                <h1 id="diff_grade2"> 分</h1>
                                <div class="btn-box"><button type="submit" class="btn submit02" onclick="$('#yiben').val(2);$('#form').submit();">确定</button></a></div>
                                </div>
                            </div>
                            <div class="close-btn"><a href="javascript:vido(0)">X</a></div>
                       </div>
                   </div>
                   </form>
               </div>

         </div>
                   <div class="fencha-box" id="show" style="display: none;">
                       <div class="fenccha-nei">
                            <div class="text">
                            <div class="btn-box"><button type="submit" class="btn submit02" onclick="$('#yiben').val(1);$('#form').submit();">确定</button></a></div>
                                <div id="sb" style="display: none">
                                <p id="msg2"></p>
                                <input type="hidden" value="40" id="diff_score2" name="diff_score2">
                                <h1 id="diff_grade2"> 分</h1>
                                <div class="btn-box"><button type="submit" class="btn submit02" onclick="$('#yiben').val(2);$('#form').submit();">确定</button></a></div>
                                </div>
                            </div>
                            <div class="close-btn"><a href="javascript:vido(0)">X</a></div>
                       </div>
                   </div>
     </div>
     </div>
<div class="clear"></div>
<!--版权-->
  <script>
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
                       document.getElementById("showData1").innerHTML = "收费版块，该模块将花费："+ res.data + "元/点击";
                       document.getElementById("dialog1").style.display = "block"
                   } else if(res.code == 2) {
                       alert(res.msg);
                   } else {
                       alert(res.msg);
                   }
               }
           });
        }

        function close1() {
          var ui = document.getElementById("dialog1");
          ui.style.display="none";
        }

    //侧边工具栏
    Do.ready(function(t) {
        var n =$("#J-g-dish");
        function scrollTop() {
            $("#J-g-dish-gotop").on("click", function(e) {
                e.preventDefault();
               $("html, body").animate({
                   scrollTop: 0
               }, 300)
            })
        }
        function preventClick() {
            n.on("click", ".wx a.icon", function(t) {
                t.preventDefault()
            }).on("click", ".faq a.icon", function(t) {
                t.preventDefault()
            })
        }
        if(n[0]){
            scrollTop();
            preventClick();
        }
        
        $(".submit01").click(function(){
            $('.batch_2').css('display', 'none');
            $('#sb').hide();

            var grade =$("#grade").val();
            var patrn = /^[0-9]*[1-9][0-9]*$/;
            var mold = $("#mold").val();
           if(grade==''||grade==null){
             alert("请输入分数!");
           }
           else if(patrn.exec(grade)== null){
              alert("请输入正确的分数!");
           }
           else{
               $.ajax({
                   'url' : '<?= \yii\helpers\Url::toRoute('site/get-batch-score')?>',
                   'dataType' : 'json',
                   'data' : 'year=' + $('#year').val() + '&mold=' + $('#mold').val() ,
                   'type' : 'get',
                   'success': function (res) {
                       if (res.code == 0) {
                           var $grade = parseInt($('#grade').val());

                           if ($grade && $grade < res['data'][2]) {
                               alert('今年分数没有达到二本线以上');
                               return false;
                           } else if ($grade && $grade >= res['data'][2] && $grade < res['data'][3]) {
                               $('#msg1').hide();
                               var msg = '您的分数线已超过' +  $('#year').val() + '二本线：';
                               $grade0 = $grade - res['data'][2] + '分';
                               $('.batch_2').css('display', 'block');
                           } else if ($grade && $grade >= res['data'][1]) {
                               var msg = '您的分数线已超过' +  $('#year').val() + '一本线：' ;
                               $grade0 = $grade - res['data'][1] + '分';

                               var msg2 = '您的分数线已超过' +  $('#year').val() + '隐性二本线：' ;
                               $grade2 = $grade - res['data'][3] + '分';
                               $('#msg2').html(msg2);
                               $('#diff_score2').val($grade2);
                               $('#diff_grade2').html($grade2);
                               $('#sb').show();

                           } else if ($grade && $grade < res['data'][1] && $grade >= res['data'][3]) {
                               var msg = '您的分数线已超过' +  $('#year').val() + '隐性二本线：' ;
                               var $grade0 = $grade - res['data'][3] + '分';
                               var msg1 = '您的分数线已超过' +  $('#year').val() + '二本线：' ;
                               var $grade1 = $grade - res['data'][2] + '分';
                               msg1 = msg1 + $grade1;
                               $('#msg1').show();
                               $('#msg1').html(msg1)
                               $('#diff_score1').val($grade1);
                               $('.batch_2').css('display', 'block');
                           } else{
                               var msg = '未找到符合条件的学校' ;
                               alert(msg);
                               return false;
                           }
                           $('#diff_score').val($grade0);
                           $('#msg').html(msg)
                           $('#diff_grade').html($grade0)
                           $(".fencha-box").show();
                       } else {
                           alert(res.message);
                       }
                   }
               });


           }
           });
         $(".close-btn").click(function(){
             $(".fencha-box").hide();
         })


    })

</script>
