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
<div id="content">
     <div class="list-banner"><img src="/frontend/web/images/list-banner.jpg" alt=""></div>
     <div class="main">
         <div class="container">
               <h3><?= $title ?></h3>
             
          <div class="list-news">
             <ul>
             <?php foreach ($articles as $article):?>
               <li>
               <div class="clearfix">
                     <div class="imgs"><a href="<?= \yii\helpers\Url::toRoute("site/article/{$article['id']}")?>" target="_blank">
                     <!-- <img src="/frontend/web/images/ebqlrlonws-aaanzaag5eqrroxg310.jpg" alt=""> -->
                     <img src="<?= app()->params['adminImgUrl'] . $article['thumbnail_image']?>" width="280" height="186" alt="中国大学十大失宠专业排行榜出炉！">
                     </a></div>
                     <div class="text">
                     <a href="<?= \yii\helpers\Url::toRoute("site/article/{$article['id']}")?>"><h4 style="overflow:hidden;text-overflow:ellipsis;isplay: -webkit-box;
    -webkit-line-clamp: 1;-webkit-box-orient: vertical; "><?= $article["title"]."..."?></h4></a>
                     <p style="overflow:hidden;text-overflow:ellipsis;isplay: -webkit-box;
    -webkit-line-clamp: 6;-webkit-box-orient: vertical;"><?= $article['intro']."...";?></p>
                     <div class="list-new-date">更新时间：2018-02-02</div>
                     <div class="list-new-more"><a href="<?= \yii\helpers\Url::toRoute("site/article/{$article['id']}")?>" target="_blank">MORE</a></div>
                     </div>
                     <div class="clearfix"></div>
                </div>
               </li>
               <?php endforeach;?>
               </ul>
               </div>
                         <!-- row start -->
          <div class="row">
            <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'nextPageLabel' => '»',
                    'prevPageLabel' => '«',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '尾页',
                ]); ?>  
                
                </div>
            </div>
          </div>
          <!-- row end -->
               </div>
               </div>
               </div>
<!--版权-->