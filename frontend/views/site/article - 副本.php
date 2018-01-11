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
<div id="header" style="height: 152px;">
    <div class="container" style="height: 0px;">
<!-- .logo -->
       <div class="logo">
            <a href="<?= app()->urlManager->baseUrl ?>"><img src="<?= app()->urlManager->baseUrl?>/css/images/logo.gif" alt="" /></a>
        </div>

<!-- /.logo -->
<!--         <form action="" id="search-form">
            <fieldset>
                <input type="text" class="text" /><input type="submit" value="Search" class="submit" />
            </fieldset>
        </form> -->
<!-- .nav -->
        <ul class="nav">
            <li><a href="<?=Url::toRoute('site/index')?>" style="padding: 0px 0px;"><span>home</span></a></li>
        </ul>
<!-- /.nav -->
    </div>
  </div>
<!-- content -->
<div id="content">
    <div class="container" style="width: 1280px;">
        <div class="wrapper">
            <div class="mainContent" style="width: auto;">
                <div class="article">
				    <div style="margin:0 auto;">
                    <p style="font-size: 36px;line-height: 1.2em;margin-bottom: 10px;text-align:center;"><?= $content[0]['title']?></p>
                    <p><?= $content[0]['content'] ?></p>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

