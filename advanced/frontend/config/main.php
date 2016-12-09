<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            //'suffix' => '.html',
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'objreservation'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'reservationinfo'],
                'reservationinfo/<action>' => 'reservationinfo/<action>',
                'tour/<id:\d+>/<dateBegin>' => 'tour/view',
//                'tour/<action:\w+>' => 'tour/<action>',
                'tour/<id:\d+>' => 'tour/view',
                'tour' => 'tour/index',
                'cart/<action>' => 'cart/<action>',
                'orders-item/<action>' => 'orders-item/view',
                'orders/cancel/<orderId:\d+>' => 'orders/cancel/<orderId:\d+>',
                'orders/<action>' => 'orders/<action>',
                'my-dashboard/<action>' => 'my-dashboard/<action>',
                'test/<action>' => 'test/<action>',
                'test' => 'test/index',
                '' => 'site/index',
                '<action>' => 'site/<action>',
            ],
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
        ],
        'request' => [
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:Y-m-d H:i',
            'timeFormat' => 'php:H:i:s',
            'timeZone' => 'UTC'
//            'dateFormat' => 'Y-MM-dd',
//            'datetimeFormat' => 'Y-MM-dd H:i',
//            'timeFormat' => 'H:i:s',
//            'locale' => 'ru-RU', //your language locale
//            'defaultTimeZone' => 'Europe/Moscow', // time zone
//            'timeZone' => 'GMT+3', // time zone
        ],
    ],
    'params' => $params,
];
