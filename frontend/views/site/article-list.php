<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '贵州高考报考查询测算平台';
AppAsset::register($this);
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
<!--大图-->

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


        <div class="container-fluid" style="width:100%;">
            <div class="col-md-9" style="width:60%;margin-left:18%;">
                <div class="list-group" style="margin:0 auto;">
                    <?php foreach ($articles as $article):?>
                    <div class="list-group-item" style="border: 0;">
                        <a href="#" style="color: #0F0F0F;"><h4><a href="<?= app()->urlManager->createUrl('article-' . $article['id'])?>"><?= $article['title']?></a></h4></a>
                        <p class="text-muted">
                            <small class="pull-right">发布时间:<?= $article['update_date']?></small>
                        </p>
                        <p class="text-muted">
                        <?php if(!empty($article['intro'])):?>
                          <?= mb_substr($article['intro'], 0 , 50,'utf-8')?> ......
                        <?php else:?>
                          <?= $article['title']?>
                        <?php endif;?>
                        </p>
                        <p>
                          <span class="badge"><?= $types[$article['type_id']]?></span>
                        </p>
                    </div>
                    <div style="border: 1px dashed #ddd;"></div>
                    <?php endforeach;?>
                    <div class="text-center">
                        <?php 
                            echo LinkPager::widget([
                                'pagination' => $pagination,
                            ]);
                        ?>
                    </div>

                </div>
            </div>
            <div style="clear:left;"></div>
        </div>
<!--版权-->
<div class="footer">
  <div class="w1200">
    <div class="fl">© 2016 贵州乾元通鸣教育信息咨询有限公司 All rights reserved. 黔ICP备14003012号</div>
    <div class="fr"> <a href="<?=Url::toRoute('site/index')?>">首页</a>|<a href="<?=Url::toRoute('site/free-list')?>">免费板块</a>|
    <a href="<?=Url::toRoute('site/article-list')?>">政策法规</a>|<a href="<?=Url::toRoute('site/article-212')?>">关于我们</a>|
    <a href="<?=Url::toRoute('site/article-242')?>">联系我们</a> 
    </div>
  </div>
</div>
<?php $this->beginBlock('footer');  ?>
<?php $this->endBlock();  ?>