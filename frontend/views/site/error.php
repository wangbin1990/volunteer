<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '404错误页面';
?>
<link rel="stylesheet" href="<?= Url::to('@web/css/dandelion.css')?>">
<style type="text/css">

</style>
    <div id="da-wrapper" class="fluid">
    
        <!-- Content -->
        <div id="da-content">
            
            <!-- Container -->
            <div class="da-container clearfix">
            
                <div id="da-error-wrapper">
                    
                    <div id="da-error-pin"></div>
                    <div id="da-error-code">
                                    
                    </div>
                    <h1 class="da-error-heading"><?= $exception->getMessage()?></h1>
                    <p><a href="<?= app()->urlManager->baseUrl ?>">点击进入首页</a></p>
                </div>
            </div>
        </div>
        
    </div>