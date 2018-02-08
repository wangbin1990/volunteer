<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'zh-CN',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7EmI1aODEGmCo7LwyKBilJ3WKe45oMsv',
        ],
        'user' => [
            'identityClass' => 'backend\models\AdminMember',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/index'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
    	'urlManager' => [
    		'showScriptName' => true,    // 这一步是将代码里链接的index.php隐藏掉。
            'enablePrettyUrl'=> true,
            'rules'=> [
                'index.html' => 'site/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>-<id:\d+>' => '<controller>/<action>',
                '<action:\w+>-<id:\d+>'=>'site/<action>',
            ],
    	],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];