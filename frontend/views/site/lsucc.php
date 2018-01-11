<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = '贵州高考志愿咨询数据平台';
?>
<!-- header -->
<div id="header" style="height: 152px;">
    <div class="container" style="height: 0px;">
<!-- .logo -->
        <div class="logo">
            <a href="index.html"><img src="images/logo.gif" alt="" /></a>
        </div>
        <ul class="nav">
            <li><a href="<?=Url::toRoute('site/index')?>" style="padding: 0px 0px;"><span>home</span></a></li>
        </ul>
<!-- /.nav -->
    </div>
  </div>
<!-- content -->
<div id="content">
    <div class="container">
        <div class="wrapper">
            <div class="mainContent" style="width: auto;">
                <div class="article">
                    <p style="font-size: 36px;line-height: 1.2em;margin-bottom: 10px;text-align:center;">欢迎来到贵州高考志愿咨询数据平台</p>
                    <hr style="margin-bottom:20px;">
                </div>
                <div class="demo-content">
                    <form class="" action="<?=Url::toRoute('site/school-list')?>">
                        <div class="row">
                          <div class="control-group" style="margin: 0 auto;padding-bottom: 10px;width:166px;">
                            <label class="control-label"><?= $cate['name'] ?>：</label>
                            <div class="controls" style="width:168px">
                              <select name="batch" class="input-normal"> 
                                 <?php if(!empty($cate)):?>
                                    <?php foreach($cate['children'] as $item):?>
                                    <option value="<?= $item['id'] ?>"><?= $item['name']?></option>
                                    <?php endforeach;?>
                                 <?php endif;?>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="control-group" style="margin: 0 auto;padding-bottom: 10px;width:166px">
                            <label class="control-label">文/理：</label>
                            <div class="controls">
                              <select name="mold" class="input-normal"> 
                                <?php if(!empty($mold)):?>
                                    <?php foreach($mold as $key => $item):?>
                                    <option value="<?= $key ?>"><?= $item ?></option>
                                    <?php endforeach;?>
                                 <?php endif;?>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                            <div style="margin:0 auto;width:137px">
                                <div class="span12 offset3 doc-content" style="margin:0 auto;width:120px;">
                                    <button type="submit" class="button button-mini button-primary" style="width: 127px;height: 38px;border-radius: 8px;">提交</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
  <div class="w1200">
    <div class="fl">© 2016 贵州乾元通鸣教育信息咨询有限公司 All rights reserved. 黔ICP备14003012号</div>
    <div class="fr"> <a href="<?=Url::toRoute('site/index')?>">首页</a>|<a href="<?=Url::toRoute('site/free-list')?>">免费板块</a>|
    <a href="<?=Url::toRoute('site/article-list')?>">政策法规</a>|<a href="<?=Url::toRoute('site/article-212')?>">关于我们</a>|
    <a href="<?=Url::toRoute('site/article-242')?>">联系我们</a>
    </div>
  </div>
</div>