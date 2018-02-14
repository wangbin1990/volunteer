<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$this->title = '贵州高考志愿咨询数据平台';
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<!--[if IE 8]><html class="ie8 lte9" lang="zh-CN"><![endif]-->
<!--[if IE 9]><html class="ie9 lte9" lang="zh-CN"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?= Yii::$app->language ?>">
<!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!--[if lt IE 9]><script type="text/javascript" src="js/html5shiv.js"></script><![endif]-->
    <script src="js/do.js" data-cfg-corelib="js/jquery.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/tabs.js"></script>
    <script src="js/160906.js"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="header" class="grid-header">
    <?php include('header.php') ?>
</div>
<div id="content">

    <?= $content ?>

</div>
<div id="footer" class="grid-footer">
    <?php include('footer.php') ?>
</div>
<?php $this->endBody() ?>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $(".login-close-btn a").click(function(){
            $(".login-bg").hide();
        });
        $(".user .login a").click(function(){
            $(".login-bg").show();
        })
        $("#login-submit-btn").click(function(){
            $(".login-bg").show();
        })
    });


    //登录JS
    $("#J-index-banner-login-submit").click(function() {
        var userName= $("#userName").val();
        var password= $("#password").val();
        if (userName && password) {
            $.ajax({
                'url' : '<?= \yii\helpers\Url::toRoute('site/login')?>',
                'dataType' : 'json',
                'data' : 'username=' + userName + '&password=' + password,
                'type' : 'post',
                'success': function (res) {
                    if (res.code == 0) {
                        //修改页面登录状态
                    } else {
                        alert(res.msg);
                    }
                }
            });
        } else {
            alert('帐号或密码不能为空');
            return false;
        }
    });


</script>

<!--共用-边工具条 end-->
<script>
    //侧边工具栏
    Do.ready(function(t) {
        var n =$("#J-g-dish");
        function scrollTop() {
            $("#J-g-dish-gotop").on("click", function(e) {
                e.preventDefault();
                $("html, body").animate({
                    scrollTop: 0
                }, 300)
            })
        }
        function preventClick() {
            n.on("click", ".wx a.icon", function(t) {
                t.preventDefault()
            }).on("click", ".faq a.icon", function(t) {
                t.preventDefault()
            })
        }
        if(n[0]){
            scrollTop();
            preventClick();
        }
    })

</script>
<?php if(isset($this->blocks['footer']) == true):?>
    <?= $this->blocks['footer'] ?>
<?php endif;?>
</html>
<?php $this->endPage() ?>


