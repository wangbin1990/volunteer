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
                   <form id="form" action="<?= Url::toRoute('site/select-school')?>" method="post">
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
                               <option value ="0">文</option>
                               <option value ="1">理</option>
                               <option value ="2">其他</option>
                           </select>
                       </li>
                       <li><span>排位：</span><input type="text"  name = "sort" placeholder="考生所在省份的排名"></li>
                       <div class="clearfix"></div>
                   </ul>
                   <div class="btn-box"><input type="button" class="btn submit01"  value="提 交"></div>
                   <div class="fencha-box">
                       <div class="fenccha-nei">
                            <div class="text">
                             <p id="msg"></p>
                             <input type="hidden" value="40" id="diff_score" name="diff_score">
                             <h1 id="diff_grade"> 分</h1>
                            <div class="batch_2" style="display: none;">
                             <input type="text"  name="batch_2" placeholder="二本数">
                             <input  type="text" name="batch_3" placeholder="老三本数">
                            </div>
                            <div class="btn-box"><button type="submit" class="btn submit02" onclick="$('#form').submit();">确定</button></a></div>
                            </div>
                            <div class="close-btn"><a href="javascript:vido(0)">X</a></div>
                       </div>
                   </div>
                   </form>
               </div>

         </div>

     </div>
     </div>
<div class="clear"></div>
<!--版权-->
  <script>


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
        //
        $(".submit01").click(function(){
            $('.batch_2').css('display', 'none');
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
                           } else if ($grade && $grade > res['data'][2] && $grade < res['data'][1]) {
                               var msg = '您的分数线已超过' +  $('#year').val() + '二本线：';
                               $grade = $grade - res['data'][2] + '分';
                               $('.batch_2').css('display', 'block');
                           } else if ($grade && $grade > res['data'][1]) {
                               var msg = '您的分数线已超过' +  $('#year').val() + '一本线：' ;
                               $grade = $grade - res['data'][1] + '分';

                           }
                           $('#diff_score').val($grade);
                           $('#msg').html(msg)
                           $('#diff_grade').html($grade)
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
