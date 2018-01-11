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
<!--公用顶部-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="http://zytbxt.angougou.cn/frontend/web/css/icon.css" rel="stylesheet">
<link href="http://zytbxt.angougou.cn/frontend/web/css/index.css" rel="stylesheet">
<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://zytbxt.angougou.cn/frontend/web/js/jquery-1.4.2.min.js"></script>
<title>贵州高考报考查询测算平台</title>
<div class="top f14">
<form method="post" action="#">
  <div class="w1200">
     <div class="top-phone fl">欢迎访问本网站,
                     <?php if(!empty($username)):?>
                    <?= $username?>&nbsp;&nbsp;<a href="<?=Url::toRoute('site/lsucc')?>" target="_blank">贵州高考志愿咨询数据平台</a>
                    <a href="<?=Url::toRoute('site/exit')?>" style="color:red;">退出登录</a>
                <?php else:?>
                <a href="http://www.gzgkzysjpt.com/frontend/web">登录查询平台</a>
                <?php endif;?>
      </div>
	 
     <div class="top-right fr">
    
       <div class="top-input fl"><input name="keywords" type="text" placeholder="请输入关键词搜索" /><input name="" type="submit" value="" /></div>
       <div class="top-login fl">
        <a href="http://www.gzgkzysjpt.com/frontend/web">学子登录</a>|<a href="http://wpa.qq.com/msgrd?v=3&uin=371205204&site=qq&menu=yes" target="_blank">开通账号</a>
               </div>
       
     </div>
     <div class="clear"></div>
  </div>
  </form>
</div>


<div class="clear"></div>
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

        <div id="content">
    <div class="container" style="width: 1280px;">
        <div class="wrapper">
            <div class="mainContent" style="width: auto;">
                <div class="article">
				    <div style=" overflow:auto; width:100%;padding:0 5px;">
                    <p style="font-size: 36px;line-height: 1.2em;margin-bottom: 10px;text-align:center;"><?= $content[0]['title']?></p>
                    <p><?= $content[0]['content'] ?></p>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<!--版权-->

