<?php

use yii\BaseYii;

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Yii extends BaseYii
{
    /**
     * @var services\Application $service
     */
    public static $service;
    /**
     * rewriteMap , like:
     * [
     *    '\models\mongodb\Category'  => 'appadmin\models\mongodb\Category'
     * ]
     */
    public static $rewriteMap;

    /**
     * @param $absoluteClassName | String , like: 'appfront\modules\Cms\block\home\Index'
     * @param $arguments | Array ,数组，里面的每一个子项就是用于实例化的一个参数，多少个子项，就代表有多个参数，用于对象的实例化。
     * 通过$rewriteMap，查找是否存在重写，如果存在，则得到重写的className
     * 然后返回 类名 和 对象
     * @return array
     * @throws ReflectionException
     */
    public static function mapGet($absoluteClassName, $arguments = []){
        $absoluteClassName = self::mapGetName($absoluteClassName);
        if (!empty($arguments) && is_array($arguments)) {
            $class = new ReflectionClass($absoluteClassName);
            $absoluteOb = $class->newInstanceArgs($arguments);

        } else {
            $absoluteOb = new $absoluteClassName;
        }

        return [$absoluteClassName, $absoluteOb];
    }

    /**
     * @param $absoluteClassName | String , like: 'frontend\modules\Cms\block\home\Index'
     * 通过$rewriteMap，查找是否存在重写，如果存在，则返回重写的className
     * @return
     */
    public static function mapGetName($absoluteClassName){
        if(isset(self::$rewriteMap[$absoluteClassName]) && self::$rewriteMap[$absoluteClassName]){
            $absoluteClassName = self::$rewriteMap[$absoluteClassName];
        }
        return $absoluteClassName;
    }

    /**
     * @param $className | String , block等className，前面没有`\`, like: 'frontend\modules\Catalog\block\product\CustomOption'
     * 通过$rewriteMap，查找是否存在重写，如果存在，则返回重写的className
     * @return false|string
     */
    public static function mapGetClassName($className){
        $absoluteClassName = '\\'.$className;
        if(isset(self::$rewriteMap[$absoluteClassName]) && self::$rewriteMap[$absoluteClassName]){
            $absoluteClassName = self::$rewriteMap[$absoluteClassName];
            return substr($absoluteClassName,1);
        }
        return $className;
    }
}


spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require __DIR__ . '/../vendor/yiisoft/yii2/classes.php';
Yii::$container = new yii\di\Container();