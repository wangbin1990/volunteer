<!-- 共用-头部 start -->
<div class="g-header">
    <div class="navTop m-nav">
        <div class="g-wrapper">
            <div class="m-nav__info"> <small>欢迎访问本网站! &nbsp; 贵州高考志愿咨询数据平台</small> </div>
            <div class="links">
                <ul class="cf">
                    <li class="user" id="J-g-header-user" data-url="/unreadtotal">
                        <!--未读消息-->
                        <?php if(app()->user->getIsGuest()):?>
                            <span class="login"><a href="javascript:vido(0)" title="请登录"><i></i>您好， [请登录]</a>&nbsp;</span>
                            <span><a href="#" title="免费注册">[免费注册]</a></span>
                        <?php else:?>
                            <span ><a href="javascript:vido(0)" title="已登录"><i></i>您好， [<?= app()->user->name;?>]</a>&nbsp;</span>
                            <span><a href="<?= \yii\helpers\Url::to('site/logout')?>" title="登出">[登出]</a></span>
                        <?php endif;?>
                    </li>
                    <li class="help"><a href="#" title="系统介绍"><i></i>平台介绍</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navMenu m-menu">
        <div class="g-wrapper">
            <div class="info">
                <h2 class="logo"> <a href="/" title=""><img src="<?= \yii\helpers\Url::to('@web/images/logo.png')?>" alt="" width="257"></a> </h2>
            </div>
            <div class="navbar">
                <ul class="cf nav-wrap">
                    <li data-homepage><a href="/" title="首页">首页</a></li>
                    <li data-learning> <a href="sjdb1.html" title="数据查询">数据查询<i></i></a>
                        <div class="submenu-pop submenu-fln">
                            <ul class="cf">
                                <li><a href="lnfsx.html" title="历年分数线">历年分数线</a></li>
                                <li><a href="sjdb1.html" title="中国名校展播">学校查询</a></li>
                                <li><a href="sjdb1.html" title="自我评估">分差查询</a></li>
                            </ul>
                        </div>
                    </li>
                    <li data-learning> <a href="sjdb1.html" title="院校数据对比">院校数据对比</a> </li>
                    <li data-zhiyuan> <a href="zymn1.html" title="志愿填报">志愿模拟</a> </li>
                    <li data-helpcenter> <a href="news1.html" title="新闻资讯">新闻资讯<i></i></a>
                        <div class="submenu-pop submenu-fln submenu-help">
                            <ul>
                                <li><a href="news1.html" title="最新公告">最新公告</a></li>
                                <li><a href="news1.html" title="关于志愿">关于志愿</a></li>
                                <li><a href="news1.html" title="历届高考资讯">历届高考资讯</a></li>
                                <li class="key-green"><a href="news1.html" title="前准备">考前准备<i></i></a></li>
                                <li><a href="news1.html" title="新闻动态">新闻动态</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="buy-card"> <a href="#" title="购买前程卡">在线开通账号</a> </div>
        </div>
    </div>
</div>
<!-- 共用-头部 end -->
<!--共用-边工具条 start-->
<div class="g-dish" id="J-g-dish">
    <ul>
        <li class="tel"> <a class="icon" href="javascript:;" target="_self"><i class="lady"></i><i class="g-iconfont">&#57346;</i><span>咨询</span></a>
            <div class="detail"> <span>全国服务热线</span> <b>4000-888-9999</b> <span class="weekdays">工作日 9:00~18:00</span> <span><a id="robot" href="#">咨询在线客服</a></span> <span><a href="#">加入官方服务群</a></span> </div>
        </li>
        <li class="wx"> <a rel="external nofollow" class="icon" href="http://bwt.zoosnet.net/LR/Chatpre.aspx?id=BWT49140730&lng=cn&p=wangzhan" target="_blank"><i class="g-iconfont">&#57366;</i><span>关注</span></a>
            <div class="detail"> <span class="wx-title">微信扫一扫<br/>
          高考资讯早知道</span> <span><img alt="站点首页" width="100" height="100" src="<?= \yii\helpers\Url::to('@web/images/20170904143553.png')?>" style="display: inline;"></span> </div>
        </li>
        <li class="back"> <a class="icon" href="/suggestion/box"><i class="g-iconfont">&#57398;</i><span>反馈</span></a> </li>
        <li class="gotop"> <a class="icon" href="javascript:;" id="J-g-dish-gotop" title="回顶部"><i class="g-iconfont iconfont-top">&#57363;</i></a> </li>
    </ul>
</div>
<div class="login-bg">
    <div class="login">
        <div class="bg bg_top">
            <div class="login-close-btn"><a href="javascript:vido(0)">X</a></div>
            <div class="clearfix"></div>
        </div>
        <div class="form">
            <h2>高考志愿数据查询系统</h2>
            <fieldset id="J-index-banner-login" data-action="/login">
                <div class="collection">
                    <div class="portion name">
                        <dl>
                            <dt></dt>
                            <dd>
                                <label><i></i></label>
                                <input id="userName" class="g-input input_clear" type="text" name="username" placeholder="账号" value="" required data-validator="请输入账号">
                                <span class="clear"></span> </dd>
                        </dl>
                    </div>
                    <div class="portion password">
                        <dl>
                            <dt></dt>
                            <dd>
                                <label><i></i></label>
                                <input id="password" class="g-input input_clear" type="password" name="password" placeholder="密码" value="" required data-validator="请输入密码">
                                <span class="clear"></span> </dd>
                        </dl>
                    </div>
                    <input type="hidden" name="_csrf" value="<?= app()->request->csrfToken ?>" />
                    <div class="portion opt">
                        <label class="g-input-checkbox">
                            <input type="checkbox" name="isRemeberMe" value="y">
                            记住账号</label>
                        <a href="#" title="点击找回密码">忘记密码？</a> </div>
                </div>
                <div class="action">
                    <button id="J-index-banner-login-submit" class="g-button g-button-main" type="button">登&nbsp;&nbsp;录</button>
                </div>
                <div class="other"> <a class="qq" href="#">快速开通<i></i></a> <a class="register" href="/register">免费注册</a> </div>
            </fieldset>
        </div>
        <div class="bg bg_bottom"></div>
    </div>
</div>