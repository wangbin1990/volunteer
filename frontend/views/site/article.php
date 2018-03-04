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
             <div class="list-banner" style="background-image:url(http://localhost/frontend/web/images/list-banner.jpg);height:300px" ></div>
    <div class="container" style="width: 1200px;padding-top: 20px;">
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

