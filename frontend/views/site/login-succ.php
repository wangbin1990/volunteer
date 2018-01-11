<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = '贵州高考志愿咨询数据平台';
$this->params['breadcrumbs'] =[
    '筛选学校',
]
?>

<!-- header -->
<?php include 'header.php';?>

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
                          <div class="control-group" style="margin: 0 auto;padding-bottom: 10px;width:166px;">
                            <label class="control-label"><?= $spec['name'] ?>：</label>
                            <div class="controls" style="width:168px">
                              <select name="spec" class="input-normal"> 
                                 <?php if(!empty($spec)):?>
								    <option value="null" selected="true">全部</option>
                                    <?php foreach($spec['children'] as $item):?>
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