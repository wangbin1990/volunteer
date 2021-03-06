<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '贵州高考志愿咨询数据平台';
AppAsset::register($this);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="http://zytbxt.angougou.cn/frontend/web/css/icon.css" rel="stylesheet">
<link href="http://zytbxt.angougou.cn/frontend/web/css/index.css" rel="stylesheet">
<script src="http://zytbxt.angougou.cn/frontend/web/js/jquery-1.4.2.min.js"></script>
<script src="http://zytbxt.angougou.cn/frontend/web/js/jquery.form.min.js"></script>
<script src="http://zytbxt.angougou.cn/frontend/web/js/slider.js"></script>

<!--<script type="text/javascript" src="/frontend/web/js/jquery-1.2.6.pack.js"></script>-->
<script type="text/javascript" src="/frontend/web/js/content_zoom.js"></script>
<link rel="stylesheet" href="/frontend/web/css/common.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('div.small_pic a').fancyZoom({scaleImg: true, closeOnClick: true});
	$('#zoom_word_1').fancyZoom({width:400, height:200});
	$('#zoom_word_2').fancyZoom();
	$('#zoom_flash').fancyZoom();
});
</script>
<title>贵州高考志愿咨询数据平台</title>
<body>
<div class="top f14">
<div style="width:1200px;margin: 0 auto;height:50px;">
<form method="post" action="#">
  <div class="w1200">
     <div class="top-phone fl">欢迎访问本网站,
                     <?php if(!empty($username)):?>
                    <?= $username?>&nbsp;&nbsp;<a href="<?=Url::toRoute('site/lsucc')?>" target="_blank">贵州高考志愿咨询数据平台</a>
                    <a href="<?=Url::toRoute('site/exit')?>" style="color:red;">退出登录</a>
                <?php else:?>
                <a href="#login">登录查询平台</a>
                <?php endif;?>
      </div>
     <div class="top-right fr">

       <div class="top-input fl"><input name="keywords" type="text" placeholder="请输入关键词搜索" /><input name="" type="submit" value="" /></div>
       <div class="top-login fl">
        <a href="#login">学子登录</a>|<a href="http://wpa.qq.com/msgrd?v=3&uin=337406395&site=qq&menu=yes" target="_blank">开通账号</a>
               </div>

     </div>
     <div class="clear"></div>
  </div>
  </form>
  </div>
</div>
<div class="clear"></div>
<!--大图-->
<div class="banner" style="positio:relative">
<!--轮播图-->
<div id="banner_tabs" class="flexslider h400">
  <ul class="slides">
      <li><a title="" href="#"><img style="background: url(http://zytbxt.angougou.cn/frontend/web/images/b1.jpg) no-repeat center;"></a></li>
      <li><a title="" href="#"><img style="background: url(http://zytbxt.angougou.cn/frontend/web/images/b1.jpg) no-repeat center;"></a></li>
  </ul>
  <ul class="flex-direction-nav">
      <li><a class="flex-prev" href="javascript:;">Previous</a></li>
      <li><a class="flex-next" href="javascript:;">Next</a></li>
  </ul>
  <ol id="bannerCtrl" class="flex-control-nav flex-control-paging">
      <li class="active"><a>1</a></li>
      <li><a>2</a></li>
  </ol>
<!--导航-->
<div class="top-nav">
    <div class="w1200">
        <div class="logo">
            <a href="#"><img src="http://zytbxt.angougou.cn/frontend/web/images/logo.png" alt=""></a>
        </div>

        <div class="nav_bar">
            <ul>
			<li><a href="<?=Url::toRoute('site/index')?>">首页</a></li>
			<li><a href="<?=Url::toRoute('site/article-list')?>">新闻资讯</a></li>
            <li><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 207])?>">关于志愿</a></li>
            <li class="l1"><a href="<?=Url::toRoute('site/free-list')?>">免费专区</a></li>
            <li class="l1"><a href="<?=Url::toRoute('site/article-212')?>">关于我们</a></li>
            <li class="l1"><a href="<?=Url::toRoute('site/article-242')?>">联系我们</a></li>

            </ul>
        </div>

    </div>
</div>
<div class="clear"></div>
<!--登录-->
<div style="padding:0; box-sizing:content-box;position:absolute;top:20%;left:50%;margin:0 0 0 -550px;">
<div class="w1251">
  <div class="login fr" id="login">
     <form  role="form" action="<?=Url::toRoute('site/login-succ')?>" method="post"  class="form-horizontal" id="login-form">
     <div class="form-signin">
      <?php if(!empty($username)):?>
          <div style="text-align:center">
          你已登录
          <br>
          <a href="<?=Url::toRoute('site/lsucc')?>" target="_blank">贵州高考志愿咨询数据平台</a>
          <br>
          <a href="<?=Url::toRoute('site/exit')?>" style="color:red;">退出登录</a>
          </div>
      <?php else:?>
     <div class="mt">
     <h1>登录</h1>
     <div class="extra-r">
     <div class="regist-link">还没注册账户？<a href="http://wpa.qq.com/msgrd?v=3&uin=337406395&site=qq&menu=yes" target="_blank">立即开通账号</a></div>
     </div>
     </div>
     <div class="form-group">
     <label class="login-label">账户</label>
     <input placeholder="" maxlength="30" name="username" id="username" class="form-control" style="height:38px;">
     </div>
     <div class="form-group">
     <label class="login-label">密码</label>
     <input placeholder="" maxlength="32" name="password" id="password" class="form-control" type="password" style="height:38px;">
     </div>

     <div class="checkbox">
     <label><input name="zidong" type="checkbox" value="1" checked="checked" style="position: relative;">下次自动登录</label>&nbsp;&nbsp;
     <a href="http://wpa.qq.com/msgrd?v=3&uin=337406395&site=qq&menu=yes"  target="_blank" style="color:#c00">忘记密码？</a>
     </div>
	 <input type="hidden" name="url" value="#">
     <button name="imageField" class="btn-block"  align="absmiddle" id="login_btn">登录</button>
     </div>
     <?php endif;?>
     </form>
  </div>
  <div class="clear"></div>
</div>
</div>

</div>

<div class="clear"></div>
</div>


<script src="js/slider.js"></script>
<script type="text/javascript">
$(function() {
  var bannerSlider = new Slider($('#banner_tabs'), {
      time: 6000,
      delay: 600,
      event: 'hover',
      auto: true,
      mode: 'fade',
      controller: $('#bannerCtrl'),
      activeControllerCls: 'active'
  });
  $('#banner_tabs .flex-prev').click(function() {
      bannerSlider.prev()
  });
  $('#banner_tabs .flex-next').click(function() {
      bannerSlider.next()
  });
})
</script>
<!--平台-->
<div class="clear"></div>
<!--关于我们-->

<div class="bg2">
<div class="w1200">
  <div class="index-title">
     <div class="index-title-line"></div>
     <h2 style="background:#FAFAFA;height:37px;width:450px;padding:0"><img src="/frontend/web/images/title_bg.png"/><span class="line1"></span><span class="line2"></span></h2>
     <p>贵州高考志愿咨询数据平台</p>
  </div>
      <ul class="index-mf mf">
	    <h2>免费专区<span class="index-more"><a href="/frontend/web/index.php/site/article-list?type_id=207" target="_blank">更多>></a></span></h2>
		
        <?php if(!empty($schools)):?>
          <?php foreach ($schools as $school):?>
            <li class="t01"><a href=" <?=app()->urlManager->createUrl('school-' . $school['id'])?>" target="_blank"><?= $school['name']?></a></li>
          <?php endforeach;?>
        <?php endif;?>
		
		<!---<div class="mf-img" style="margin-top:5px;"><a href="/frontend/web/index.php/article-301" target="_blank"><img src="/frontend/web/images/index_zymnt.jpg" width="257px"/></a></div> -->
<li class="t02"><a href="/frontend/web/index.php/article-301" target="_blank">查看模拟志愿参考</a></li>
       <div class="clear"></div>
    </ul>
  <div class="index_contact">
       <div class="index-news">
	  <div class="index-news-title">
		 <div class="news-title"></div>
		 <h2>关于志愿<span class="index-more"><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 207]);?>" target="_blank">更多>></a></span></h2>

	  </div>
	  <div class="new-left">

	  <div class="new-text">
		  <div class="new-img"><a href="/frontend/web/index.php/article-284" target="_blank"><img src="/frontend/web/images/zn.jpg" width="215px" height="145px"/></a></div>
		</div>
		<div class="new-text">
		  <div class="new-img">
		  <a href="/frontend/web/index.php/article-299" target="_blank"><img src="http://zytbxt.angougou.cn/frontend/web/images/02.jpg" width="215px" height="145px;"/></a>
		  
		  	 <!--<div class="small_pic">
                        <a href="#pic_noe">
                            <img src="/frontend/web/images/02.jpg" />
                        </a>
                    </div>
  

            <div id="pic_noe" style="display:none;"><img src="/frontend/web/images/02.jpg" /></div>-->
  
		  
		  </div>
		</div>
	  </div>
	  <div class="new-right">
		<ul class="new-list" style="height:350px">
							<?php if(!empty($content_a)):?>
							<?php foreach ($content_a as $content_a):?>
								<li><em style="float:right;"><?= $content_a['update_date']?></em><a href="<?=app()->urlManager->createUrl('article-' . $content_a['id'])?>" target="_blank"><?= $content_a['title']?></a></li>
							<?php endforeach;?>
						<?php endif;?>

		<div class="clear"></div>
		</ul>
		<div class="more"><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 207]);?>" target="_blank">查看全部</a></div>
	  </div>
	  <div class="clear"></div>
	</div>
  </div>

  <div class="clear"></div>

</div>
</div>
<div class="bg1">
<div class="w1200">
 <!-- <div class="index-title">
     <div class="index-title-line"></div>
     <h2>贵州高考志愿咨询数据平台<span class="line1"></span><span class="line2"></span></h2>
     <p>贵州高考志愿咨询数据平台，您身边的报考专家</p>
  </div>-->
  <div class="w1200">
   
	<div class="index-news">
	  <div class="index-news-title">
		 <div class="news-title"></div>
		 <h2>历届高考资讯<span class="index-more"><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 208]);?>" target="_blank">更多>></a></span></h2>

	  </div>
	  <div class="new-left">

	  <div class="new-text">
		  <div class="new-img">
		  <div class="small_pic">
                        <a href="#pic_two">
                            <img src="/frontend/web/images/01.jpg" />
                        </a>
            </div>


          <div id="pic_two" style="display:none;"><img src="/frontend/web/images/01.jpg" /></div>
		 <!-- <a href="#"><img src="http://zytbxt.angougou.cn/frontend/web/images/01.jpg" width="215px" height="145px" /></a>-->
		  
		  </div>
		</div>
		<div class="new-text">
		  <div class="new-img">
		  <div class="small_pic">
                        <a href="#pic_three">
                            <img src="/frontend/web/images/04.jpg" />
                        </a>
            </div>


          <div id="pic_three" style="display:none;"><img src="/frontend/web/images/04.jpg" /></div>
		 <!--- <a href="#"><img src="http://zytbxt.angougou.cn/frontend/web/images/02.jpg" width="215px" height="145px" /></a>-->
		 </div>

		</div>

	  </div>
	  <div class="new-right">
		<ul class="new-list" style="height:350px">
							<?php if(!empty($content_b)):?>
							<?php foreach ($content_b as $content_b):?>
								<li><em style="float:right;"><?= $content_b['update_date']?></em><a href="<?=app()->urlManager->createUrl('article-' . $content_b['id'])?>"><?= $content_b['title']?></a></li>
							<?php endforeach;?>
						<?php endif;?>

		<div class="clear"></div>
		</ul>
		<div class="more"><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 208]);?>" target="_blank">查看全部</a></div>
	  </div>
	  <div class="clear"></div>
	</div>

		<ul class="index-mf">
				<h2>最新公告<span class="index-more"><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 210]);?>" target="_blank">更多>></a></span></h2>
								 <?php if(!empty($content_d)):?>
								<?php foreach ($content_d as $content_d):?>
									<li class="t01"><a href="<?=app()->urlManager->createUrl('article-' . $content_d['id'])?>" target="_blank"><?= $content_d['title']?></a></li>
								<?php endforeach;?>
									
								
							<?php endif;?>

			   <div class="clear"></div>
			</ul>



  </div>
  
</div>

<!------->

<div class="w1200">

  <div class="w1200">
    <ul class="index-mf">
	    <h2>关于我们<span class="index-more"><a href="/frontend/web/index.php/site/article-list" target="_blank">更多>></a></span></h2>
                         <?php if(!empty($content_c)):?>
                        <?php foreach ($content_c as $content_c):?>
                            <li class="t01"><a href="<?=app()->urlManager->createUrl('article-' . $content_c['id'])?>" target="_blank"><?= $content_c['title']?></a></li>
                        <?php endforeach;?>
                    <?php endif;?>

       <div class="clear"></div>
    </ul>
	<!----->
	<div class="index-news">
	  <div class="index-news-title">
		 <div class="news-title"></div>
		 <h2>考前准备<span class="index-more"><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 211]);?>" target="_blank">更多>></a></span></h2>

	  </div>
	  <div class="new-left">

	  <div class="new-text">
		  <div class="new-img">
		  <!--<a href="#"><img src="http://zytbxt.angougou.cn/frontend/web/images/03.jpg" width="215px" height="145px" /></a>-->
		  <div class="small_pic">
                        <a href="#pic_five">
                            <img src="/frontend/web/images/03.jpg" />
                        </a>
            </div>


          <div id="pic_five" style="display:none;"><img src="/frontend/web/images/03.jpg" /></div>
		  </div>
		</div>
		<div class="new-text">
		  <div class="new-img">
		  <!--<a href="#"><img src="http://zytbxt.angougou.cn/frontend/web/images/04.jpg" width="215px" height="145px" /></a>-->
		  <div class="small_pic">
                        <a href="#pic_four">
                            <img src="/frontend/web/images/002.jpg" />
                        </a>
                    </div>
    <!-- 要放大显示的div -->

          <div id="pic_four" style="display:none;"><img src="/frontend/web/images/002.jpg" /></div>
		  
		  
		  </div>

		</div>

	  </div>
	  <div class="new-right">
		<ul class="new-list" style="height:350px">

		  <?php if(!empty($content_e)):?>
			<?php foreach ($content_e as $content_e):?>
				<li><em style="float:right;"><?= $content_e['update_date']?></em><a href=" <?=app()->urlManager->createUrl('article-' . $content_e['id'])?>" target="_blank">
				<?= $content_e['title']?></a>
				
				</li>
			<?php endforeach?>
		<?php endif;?>

		<div class="clear"></div>
		</ul>
		<div class="more"><a href="<?=Url::toRoute(['site/article-list', 'type_id' => 211]);?>" target="_blank">查看全部</a></div>
	  </div>
	  <div class="clear"></div>
	</div>
	
  </div>
  
  
</div>








</div>
 <div class="clear"></div>

<div class="link">
<div class="link-box" style=""><span>友情链接：</span>
<a href="http://www.gzszk.com" target="_blank">省招生考试院官网</a>
</div>
</div>
<!--版权-->

<div class="footer">
  <div class="w1200">
    <div class="fl">© 2016 贵州乾元通鸣教育信息咨询有限公司 All rights reserved. 黔ICP备14003012号</div>
    <div class="fr"> <a href="<?=Url::toRoute('site/index')?>" target="_blank">首页</a>|<a href="<?=Url::toRoute('site/free-list')?>" target="_blank">免费板块</a>|
    <a href="<?=Url::toRoute('site/article-list')?>" target="_blank">政策法规</a>|<a href="<?=Url::toRoute('site/article-212')?>" target="_blank">关于我们</a>|
    <a href="<?=Url::toRoute('site/article-242')?>" target="_blank">联系我们</a>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
//placeholder IE8
var _placeholderSupport = function() {
 var t = document.createElement("input");
 t.type = "text";
 return (typeof t.placeholder !== "undefined");
}();
window.onload = function() {
 var arrInputs = document.getElementsByTagName("input");
 for (var i = 0; i < arrInputs.length; i++) {
     var curInput = arrInputs[i];
     if (!curInput.type || curInput.type == "" || curInput.type == "text")
         HandlePlaceholder(curInput);
 }
};

function HandlePlaceholder(oTextbox) {
 if (!_placeholderSupport) {
     var curPlaceholder = oTextbox.getAttribute("placeholder");
     if (curPlaceholder && curPlaceholder.length > 0) {
         oTextbox.value = curPlaceholder;
         oTextbox.setAttribute("old_color", oTextbox.style.color);
         oTextbox.style.color = "#666";
         oTextbox.onfocus = function() {
             this.style.color = this.getAttribute("old_color");
             if (this.value === curPlaceholder)
                 this.value = "";
         };
         oTextbox.onblur = function() {
             if (this.value === "") {
                 this.style.color = "#666";
                 this.value = curPlaceholder;
             }
         }
     }
 }
}
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function tijiao()
{
document.getElementById('form1').submit();
}
</script>
<script>

$('#login_btn').click(function (e) {
    e.preventDefault();
    var user = $('#username').attr();
    var pwd = $('#password').attr();
    $('#login-form').submit();
});
$('#login-form').bind('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        type: "post",
        dataType:"json",
        url: "<?=Url::toRoute('site/login-succ')?>",
        success: function(value)
        {
            if(value.errno == 0 || value.errno == 1){

                window.location.href = "<?=Url::toRoute('site/lsucc')?>";
            }
            else{
                alert("用户名或密码错误！");
            }

        }
    });
});
</script>