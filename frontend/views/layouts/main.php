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
    <script src="<?= \yii\helpers\Url::to('@web/js/do.js', true);?>" data-cfg-corelib="<?= \yii\helpers\Url::to('@web/js/jquery.js', true);?>"></script>
    <script src="<?= \yii\helpers\Url::to('@web/js/jquery.js', true);?>"></script>
    <script src="<?= \yii\helpers\Url::to('@web/js/tabs.js', true);?>"></script>
    <script src="<?= \yii\helpers\Url::to('@web/js/160906.js', true);?>"></script>
    <script src="<?= \yii\helpers\Url::to('@web/js/chart.js', true);?>"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= Alert::widget() ?>
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
            $(".login-balance-bg").hide();
        });
        $(".user .login a").click(function(){
            $(".login-bg").show();
        })
        $("#login-submit-btn").click(function(){
            $(".login-bg").show();
        })

        $(".user .add_balance").click(function(){
            $(".login-balance-bg").show();
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
                        window.location.reload();
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

    //获取支付图片
    function getPayCode (amount, remark)
    {
        $.ajax({
            type: "GET",
            url: "<?=\yii\helpers\Url::toRoute('site/get-pay-code')?>",
            data: {"amount":amount, "remark":remark},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
            },
            success: function(data){
                if (data.code !== 0) {
                    alert(data.message);
                    return;
                }
                var url ="http://paysdk.weixin.qq.com/example/qrcode.php?data=" + encodeURIComponent(data.data);
                $('#payImage').css('display', 'block');
                $('#payImage').attr('src', url);

            }
        });
    }
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


