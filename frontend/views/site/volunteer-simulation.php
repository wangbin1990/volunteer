<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '贵州高考志愿咨询数据平台';
?>
<!-- header -->
<div class="clear"></div>
<div id="content">
     <div class="list-banner"><img src="/frontend/web/images/list-banner.jpg" alt=""></div>
     <div class="main">
         <div class="container">
               <h3>志愿模拟</h3>
               <div class="main-moni">
                   <ul>
                       <li><span>年份：</span>
                           <select>
                           <option value ="2018">2018</option>
                           <option value ="2017">2017</option>
                           <option value ="2017">2016</option>
                           </select>
                        </li>
                         <li><span>考分：</span><input type="text" placeholder="考生考分" name="grade" id="grade"></li>
                       <li><span>文理：</span><select>
                           <option value ="文">文</option>
                           <option value ="理">理</option>
                           </select>
                       </li>
                       <li><span>排位：</span><input type="text" placeholder="考生所在省份的排名"></li>
                       <div class="clearfix"></div>
                   </ul>
                   <div class="btn-box"><button type="submit" class="btn submit01">提 交</button></div>
                   <div class="fencha-box">
                       <div class="fenccha-nei">
                            <div class="text">
                             <p>您的分数线已经超过2018年一本线：</p>
                             <h1>65 分</h1>
                             <div class="btn-box"><a href="#"><button type="submit" class="btn submit02">确定</button></a></div>
                            </div>
                            <div class="close-btn"><a href="javascript:vido(0)">X</a></div>
                       </div>
                   </div>
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
          
            var grade =$("#grade").val();
            var patrn = /^[0-9]*[1-9][0-9]*$/;

           if(grade==''||grade==null){
             alert("请输入分数!");
           }
           else if(patrn.exec(grade)== null){
              alert("请输入正确的分数!");
           }
           else{
              alert("志愿模拟正在开发中");
            // $(".fencha-box").show();
           }
           });
         $(".close-btn").click(function(){
             $(".fencha-box").hide();
         })


    })

</script>
