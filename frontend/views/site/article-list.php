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
                    </div>
                    <div style="border: 1px dashed #ddd;"></div>
                    <?php endforeach;?>
<!--                     <div class="text-center">
                        <?php 
                            echo LinkPager::widget([
                                'pagination' => $pagination,
                            ]);
                        ?>
                    </div> -->

                </div>
            </div>
            <div style="clear:left;"></div>
        </div>
<!--版权-->