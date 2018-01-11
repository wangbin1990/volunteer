<?php 
use yii\widgets\Breadcrumbs;
use backend\models\AdminMember;
use yii\helpers\Url;
    
?>

 <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<div id="header" style="height: 152px;">
    <div class="container" style="height: 0px;">
<!-- .logo -->
       <div class="logo">
            <a href="<?= app()->urlManager->baseUrl ?>"><img src="<?= app()->urlManager->baseUrl?>/css/images/logo.gif" alt="" /></a>
        </div>
        <div>
            <?php if (!app()->user->isGuest):?>
            <span> 欢迎您！ <?= app()->session->get('username')?>,次数(<?= AdminMember::findIdentity(app()->user->id)->num?>)</span>
            <?php else:?>
            <span><a href="<?= Url::to(['site/index'])?>">请登陆</a></span>
            <?php endif;?>
        </div>
<!-- /.logo -->
<!--         <form action="" id="search-form">
            <fieldset>
                <input type="text" class="text" /><input type="submit" value="Search" class="submit" />
            </fieldset>
        </form> -->
<!-- .nav -->
		  <?= Breadcrumbs::widget([
			 'homeLink' => [  
				'label' => '首页',  
				'url' => ['site/index'],  
				'template' => "<li><b>{link}</b></li>\n",  
				'class' => 'header'  
			],  
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			'options' => ['class' => 'breadcrumb']  
        ]) ?>
<!-- /.nav -->
    </div>
  </div>
  <style type="text/css">
/*    .header > li + li:before{
        width:960px;
        text-align: center;
        padding-top:30px;
        float:right;
        color: #CCCCCC;
        content: "/ ";
        padding: 0 5px;
    }*/
    .breadcrumb a{
        color:#0377dd;
    }


    .breadcrumb a:hover{ 
        color:#037700; 
    }

    .breadcrumb {
      padding: 8px 15px;
      margin-bottom: 20px;
      list-style: none;
      background-color: #eaeaea;
      border-radius: 4px;
      margin-top:88px;
      float: right;
    }

    .breadcrumb > li {
      display: inline-block;
    }

    .breadcrumb > li + li:before {
      padding: 0 5px;
      color: #0377dd;
      content: "/";
    }

    .breadcrumb > .active {
      color: #777;
    }
</style>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>