<?php

$http = ($_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
$homeUrl = $http.'://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['SCRIPT_NAME']), '\\/');

/**
 * @zhangjinyu
 * 配置文件缓存是否开启,后期可以配置到内存中
 */
$use_merge_config_file = false;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';

/**
 * @zhangjinyu
 * 增加Yii扩展文件，方便重写Yii核心库
 */
require __DIR__ . '/../../yiiCore/Yii.php';

require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';


if ($use_merge_config_file) {
    $config = require('./merge_config.php');
} else {
    $config = yii\helpers\ArrayHelper::merge(
        require __DIR__ . '/../../common/config/main.php',
        require __DIR__ . '/../../common/config/main-local.php',
        require __DIR__ . '/../config/main.php',
        require __DIR__ . '/../config/main-local.php',

        /**
         * @zhangjinyu
         * 引入service层配置
         */
        require __DIR__ . '/../../common/config/service.php'
    );
}



$config['homeUrl'] = $homeUrl;
/**
 * 添加服务层services，Yii::$service ， 将services的配置添加到这个对象。
 * 使用方法：Yii::$service->cms->article;
 * 上面的例子就是获取cms服务的子服务article
 */
new services\Application($config);

try {
    (new yii\web\Application($config))->run();
} catch (\yii\base\InvalidConfigException $e) {
    print_r($e);
}
