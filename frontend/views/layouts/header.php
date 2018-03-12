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
                            <span><a href="javascript:vido(0)" title="余额">[余额：<?= app()->user->walletBalance ?>]</a></span>
                            <span class="add_balance"><a href="javascript:vido(0)" title="充值">[充值]</a></span>
                            <span><a href="<?= \yii\helpers\Url::toRoute('site/logout')?>" title="登出">[登出]</a></span>
                        <?php endif;?>
                    </li>
                    <li class="help"><a href="/frontend/web/index.php/site/article-list?type_id=209&title=关于我们" title="系统介绍"><i></i>平台介绍</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navMenu m-menu">
        <div class="g-wrapper">
            <div class="info">
                <h2 class="logo"> <a href="/frontend/web" title=""><img src="<?= \yii\helpers\Url::to('@web/images/logo.png')?>" alt="" width="257"></a> </h2>
            </div>
            <div class="navbar">
                <ul class="cf nav-wrap">
                    <li data-homepage><a href="/frontend/web" title="首页">首页</a></li>
                    <li data-learning> <a href="/frontend/web/index.php/site/lsucc" title="数据查询" target="_blank">数据查询<i></i></a>
                        <div class="submenu-pop submenu-fln">
                            <ul class="cf">
                                <li><a href="/frontend/web/index.php/site/score-line" title="历年分数线" target="_blank">历年分数线</a></li>
                                <li><a href="/frontend/web/index.php/site/lsucc" title="中国名校展播" target="_blank">学校查询</a></li>
                                <li><a href="/frontend/web/index.php/site/lsucc" title="自我评估" target="_blank">分差查询</a></li>
                            </ul>
                        </div>
                    </li>
                    <li data-learning> <a href="/frontend/web/index.php/site/lsucc" title="院校数据对比" target="_blank">院校数据对比</a> </li>
                    <li data-zhiyuan> <a href="/frontend/web/index.php/site/volunteer-simulation" title="志愿填报" target="_blank">志愿模拟</a> </li>
                    <li data-helpcenter> <a href="/frontend/web/index.php/site/article-list?title=新闻资讯" title="新闻资讯" target="_blank">新闻资讯<i></i></a>
                        <div class="submenu-pop submenu-fln submenu-help">
                            <ul>
                                <li><a href="/frontend/web/index.php/site/article-list?type_id=210&title=最新公告" title="最新公告" target="_blank">最新公告</a></li>
                                <li><a href="/frontend/web/index.php/site/article-list?type_id=207&title=关于志愿" title="关于志愿" target="_blank">关于志愿</a></li>
                                <li><a href="/frontend/web/index.php/site/article-list?type_id=208&title=历届高考资讯" title="历届高考资讯" target="_blank">历届高考资讯</a></li>
                                <li class="key-green"><a href="/frontend/web/index.php/site/article-list?type_id=211&title=考前准备" title="考前准备" target="_blank">考前准备<i></i></a></li>
                                <li><a href="/frontend/web/index.php/site/article-list?type_id=209&title=关于我们" title="新闻动态" target="_blank">关于我们</a></li>
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

<div class="login-balance-bg">
    <div class="login">
        <div class="bg bg_top">
            <div class="login-close-btn"><a href="javascript:vido(0)">X</a></div>
            <div class="clearfix"></div>
        </div>
        <div class="form">
            <h2>扫码支付</h2>
            <fieldset id="J-index-banner-login" data-action="/login">
                <div class="collection">
                    <div class="portion name">
                        <dl>
                            <dt></dt>
                            <dd>
                                <label><i></i></label>
                                <input id="name" class="g-input input_clear" readonly type="text" name="username" placeholder="账号" value="<?= app()->user->name?>" required data-validator="请输入账号">
                                <span class="clear"></span> </dd>
                        </dl>
                    </div>
                    <div class="portion password">
                        <dl>
                            <dt></dt>
                            <dd>
                                <label><i></i></label>
                                <input id="banlance" class="g-input input_clear" type="text" name="password" placeholder="金额" value="" required data-validator="请输入密码">
                                <span class="clear"></span> </dd>
                        </dl>
                    </div>
                    <div class="portion password">
                        <dl>
                            <dt></dt>
                            <dd>
                                <label><i></i></label>
                                <input id="remark" class="g-input input_clear" type="text" name="remark" placeholder="备注" value="" required data-validator="请输入密码">
                                <span class="clear"></span> </dd>
                        </dl>
                    </div>
                    <div class="portion password">
                        <dl>
                            <dt></dt>
                            <dd>
                                <img id="payImage" alt="模式二扫码支付" src="" style="width: 150px; height: 150px; display: none; margin: 0px auto;">
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="action">
                    <button id="J-index-banner-login-submit" class="g-button g-button-main" type="button"  onclick="return getPayCode($('#banlance').val(), $('#remark').val())" >确&nbsp;&nbsp;定</button>
                </div>
            </fieldset>
        </div>
        <div class="bg bg_bottom"></div>
    </div>
</div>
