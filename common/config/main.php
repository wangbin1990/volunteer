<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//         'cache' => [
//             'class' => 'yii\caching\MemCache',
//             'servers' => [
//                 [
//                     'host' => '127.0.0.1',
//                     'port' => 11211,
//                     'weight' => 60,
//                 ],
//             ],
//         ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=114.215.154.112;dbname=gzgkzysjpt',
            'username' => 'gzgkzysjpt',
            'password' => 'ph823zll0kp5q0O',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
    ],
    
];
