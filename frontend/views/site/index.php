<div class="grid-body">
    <!-- 首页-banner start -->
    <div class="index-banner index-banner__page" id="J-index-banner">

        <div class="login login-s">
            <div class="bg bg_top">
                <div class="login-close-btn"><a href="javascript:vido(0)">X</a></div>
                <div class="clearfix"></div>
            </div>
            <div class="form">
                <h2>高考志愿数据查询系统</h2>
                <fieldset id="J-index-banner-login" data-action="">
                    <div class="collection">
                        <div class="action">
                            <a href="/frontend/web/index.php/site/lsucc"><button id="J-index-banner-login-submit" class="g-button g-button-main" type="button">免&nbsp;&nbsp;费&nbsp;&nbsp;登&nbsp;&nbsp;录</button></a>
                        </div>
                        <div class="action">
                            <!--未读消息-->
                        <?php if(app()->user->getIsGuest()):?>
                            <button id="login-submit-btn" class="g-button g-button-main" type="button">会&nbsp;&nbsp;员&nbsp;&nbsp;登&nbsp;&nbsp;录</button>
                        <?php else:?>
                            <a href="/frontend/web/index.php/site/lsucc">
                            <button id="J-index-banner-login-submit" class="g-button g-button-main" type="button">您&nbsp;&nbsp;已&nbsp;&nbsp;登&nbsp;&nbsp;录</button></a>
                        <?php endif;?>
                        </div>
                        <div class="portion opt">
                            <label class="g-input-checkbox">
                                <input type="checkbox" name="isRemeberMe" value="1">
                                记住账号</label>
                            <a href="#" title="点击找回密码">忘记密码？</a> </div>
                    </div>

                    <div class="other"> <a class="qq" href="#">快速开通<i></i></a> <a class="register" href="<?= \yii\helpers\Url::toRoute('site/register')?>">免费注册</a> </div>
                </fieldset>
            </div>
            <div class="bg bg_bottom"></div>
        </div>



        <div class="slide banner-slide">
            <div class="g-carousel" id="J-index-banner-slide">
                <div class="g-carousel-viewport">
                    <ul class="g-carousel-inner">
                        <li><a href="#" style="background-image:url(<?= \yii\helpers\Url::to('@web')?>/images/20170906113803.jpg);" title="学习提升"></a></li>
                        <li><a href="#" style="background-image:url(<?= \yii\helpers\Url::to('@web')?>/images/20170906113803.jpg);" title="高考志愿智能模拟"></a></li>
                        <li><a href="#" style="background-image:url(<?= \yii\helpers\Url::to('@web')?>/images/20170906113803.jpg);" title="专家一对一咨询"></a></li>
                    </ul>
                </div>
                <ul class="g-carousel-indicators">
                </ul>
            </div>
        </div>
    </div>
    <!-- 首页-banner end -->
    <!-- 首页-功能入口 start -->
    <div class="index-section  index-servicePlatform">
        <div class="hd">
            <h2><span>高考志愿咨询数据平台</span></h2>
            <h5>掌握数据您就是志愿专家</h5>
        </div>
        <div class="bd">
            <div class="g-wrapper">
                <ul class="service-list cf">
                    <li><a href="/frontend/web/index.php/site/volunteer-simulation">
                            <div class="icon"><i></i><span class="g-iconfont">&#57367;</span></div>
                            <h3>智能填报系统</h3>
                            <p>多种填报模式，梯度配置，更具个性化</p>
                        </a></li>
                    <li><a href="/frontend/web/index.php/site/lsucc">
                            <div class="icon"><i></i><span class="g-iconfont">&#57368;</span></div>
                            <h3>历年数据查询</h3>
                            <p>2010-2017的官方权威数据</p>
                        </a> </li>
                    <li><a href="/frontend/web/index.php/site/lsucc">
                            <div class="icon"><i></i><span class="g-iconfont">&#57369;</span></div>
                            <h3>按地区筛选学校</h3>
                            <p>地区精准定位筛选</p>
                        </a></li>
                    <li> <a href="/frontend/web/index.php/site/lsucc">
                            <div class="icon"><i></i><span class="g-iconfont">&#57376;</span></div>
                            <h3>按分差筛选学校</h3>
                            <p>历年院校分差数据</p>
                        </a></li>

                </ul>
            </div>
        </div>
    </div>
    <!-- 首页-功能入口 end -->
    <!--首页-新闻资讯 start！-->
    <div class="index-article index-highDynamic">
        <div class="g-wrapper">
            <div class="hd">
                <h5>高考资讯</h5>
            </div>
            <?php if(!empty($articles)):?>
            <div class="bd">
                <div class="index-article__tabs">
                    <ul class="cf" id="J-highDynamic-tabs">
                        <?php foreach ($articles as $key => $article):?>
                            <li><a href="javascript:;"><?= $key?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="high-cont" id="J-highDynamic-cont">
                    <?php foreach ($articles as $key => $oneArticles):?>
                    <!--高中动态-->
                    <div class="high-cont__list">
                        <ul class="cf">
                            <!--左侧-->
                            <li class="cont--left">
                                <?php $leftArticle = array_shift($oneArticles);?>
                                <div class="left--pic"><img src="<?= app()->params['adminImgUrl'] . $leftArticle['thumbnail_image']?>" width="356" height="236" alt="中国大学十大失宠专业排行榜出炉！"/></div>
                                <h3 style="width:356px;overflow:hidden;text-overflow:ellipsis; "><?= $leftArticle['title'];?></h3>
                                <p>时间：<?= $leftArticle['update_date']?></p>
                                <div class="left--txt" style="width:356px;overflow:hidden;text-overflow:ellipsis;display: -webkit-box;
    -webkit-line-clamp: 3;-webkit-box-orient: vertical;"> <?= $leftArticle['intro']; ?>
                                    [<a href="<?= \yii\helpers\Url::toRoute("site/article/{$leftArticle['id']}")?>">查看全文</a>] </div>
                            </li>
                            <!--右侧-->
                            <li class="cont--right">
                                <ul class="right--wrap cf">
                                    <?php foreach ($oneArticles as $article):?>
                                    <li> <a href="<?= \yii\helpers\Url::toRoute("site/article/{$article['id']}")?>">
                                            <dl>
                                                <dt><img src="<?= app()->params['adminImgUrl'] . $article['thumbnail_image']?>" width="150" height="100" alt=""/></dt>
                                                <dd>
                                                    <h4 style="width:150px;overflow:hidden;text-overflow:ellipsis;display: -webkit-box;
    -webkit-line-clamp: 2;-webkit-box-orient: vertical; "><?= $article['title'];?></h4>
                                                    <p style="width:150px;overflow:hidden;text-overflow:ellipsis;display: -webkit-box;
    -webkit-line-clamp: 3;-webkit-box-orient: vertical;"> <?= $article['intro']; ?></p>
                                                </dd>
                                            </dl>
                                        </a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                        </ul>

                                        <div class="index-article__button" style="display: block;"> <a class="g-button                                 g-button-dark-line" href="/frontend/web/index.php/site/article-list?type_id=<?=  $article['type_id']?>" title="关于志愿" target="_blank">查看更多</a> </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
    <!--首页-高中动态 end！-->
</div>
<?php $this->beginBlock('footer')?>
<script>
    Do.ready(function () {
        $(".navbar .nav-wrap [data-homepage]").addClass("active");
    });
    // 首页-bannner
    Do.ready('http://s.diyigaokao.com/v5/script/core/validator.js', 'http://s.diyigaokao.com/v5/script/plugin/carousel.js', function () {
        var banner = $('#J-index-banner-slide'),
            form = $('#J-index-banner-login'),
            input_password = form.find('input[name="password"]'),
            btn_smt = $('#J-index-banner-login-submit'),

            // 获取url参数
            request = function (paras) {
                var url = window.location.href;
                var paraString = url.substring(url.indexOf('?') + 1, url.length).split('&');
                var paraObj = {}
                for (i = 0; j = paraString[i]; i++) {
                    paraObj[j.substring(0, j.indexOf('=')).toLowerCase()] = j.substring(j.indexOf('=') + 1, j.length);
                }
                var returnValue = paraObj[paras.toLowerCase()];
                if (typeof (returnValue) == 'undefined') {
                    return '';
                } else {
                    return returnValue;
                }
            },
            // 清除input内容
            inputClear = function (e) {
                var input = $('input.' + e);
                input.each(function (i) {
                    input.eq(i).next('span.clear').on('click', function () {
                        input.eq(i).val('').focus();
                    });
                });
            };

        $('a[data-userauthority]').on("click", function (c) {
            if ($PAGE_CONFIG["UType"] == 0) {
                c.preventDefault();
                c.stopImmediatePropagation();
                GaoKao.userAuthority._showLogin();
                return
            }
            if (($PAGE_CONFIG["UType"] < 3 || $PAGE_CONFIG["UType"] == 5) && $(this).attr("data-userauthority") >= 5) {

                c.preventDefault();
                c.stopImmediatePropagation();
                GaoKao.userAuthority._showVip('钻石卡');
                return
            }
        });




        // inputClear
        inputClear('input_clear');

        // 轮播
        banner.carousel({
            control: false
        });
    });


    //首页--news
    Do.define('tabs', {
        path: "<?= \yii\helpers\Url::to('@web/js/tabs.js')?>",
        type: 'js'
    });
    Do.ready('tabs', function() {
        $('#J-qualityCourse-tabs').tabs({
            tabContentBox: '#J-qualityCourse-cont',
            event: 'click',
            initState: 0
        });

        $('#J-learnMeans-tabs').tabs({
            tabContentBox: '#J-learnMeans-cont',
            event: 'click',
            initState: 0
        });

        $('#J-highDynamic-tabs').tabs({
            tabContentBox: '#J-highDynamic-cont',
            event: 'click',
            initState: 0
        });
    });

</script>
<?php $this->endBlock('footer')?>