<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'appVersion' => '1.0.0',
    'appName' => 'YiiBoot',
    'homePage' => 'http://git.oschina.net/penngo/chadmin',
    'imgUrl' => function () {
        return app()->urlManager->baseUrl . '/uploadImages';
    },
    'wxPayNotifyUrl' => '',
    'charge_module_list' => [
        '0'  => 'unknow module',
        '1'  => '按地区筛选学校',
        '2'  => '按分差筛选学校',
        '3'  => '院校数据对比',
        '4'  => '智能填报',
        '5'  => '专业录取分数',
    ],
    'parallel_volunteer_list' => [
        '0'  => '请选择',
        '1'  => '第一档',
        '2'  => '第二档',
        '3'  => '第三档',
        '4'  => '第四档',
        '5'  => '第五档',
        '6'  => '第六档',
        '7'  => '第七档',
        '8'  => '第八档',
    ],
];
