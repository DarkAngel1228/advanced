<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php'
);

return [
    'id' => 'app-api',
    'defaultRoute' => 'user/user/index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'enablePrettyUrl' => true, // 美化URL
            'showScriptName' => false, // 是否隐藏index.php
            'enableStrictParsing' => false, // 是否开启严格解析
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['account/login'],
                    'pluralize' => false,    //设置为false 就可以去掉复数形式了(官方推荐：保留复数形式。但是我个人在开发中，习惯于与控制器一一对应，所以是取消了复数形式)
                    'extraPatterns'=>[
                        'POST send-email' => 'send-email'

                    ],
                ]
            ],
        ],
    ],
    'params' => $params,
];
