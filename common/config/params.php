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
    'charge_module_list' => [
        '0'  => 'unkonw module',
        '1'  => '按地区筛选学校',
        '2'  => '按分差筛选学校',
        '3'  => '院校数据对比',
        '4'  => '智能填报',
        '5'  => '专业录取分数',
    ],
];
