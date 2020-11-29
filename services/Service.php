<?php

namespace services;

use Yii;
use yii\base\BaseObject;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;

class Service extends BaseObject
{
    public $childService;

    public $enableService = true; // 该服务是否可用

    protected $_childService;

    protected $_beginCallTime;

    protected $_beginCallCode;

    protected $_callFuncLog;


    public function __get($attr)
    {
        return $this->getChildService($attr);
    }

    /**
     * 通过call函数，去调用actionXxxx方法
     * @param $originMethod
     * @param $arguments
     */
    public function __call($originMethod, $arguments)
    {
        if (isset($this->_callFuncLog[$originMethod])) {
            $method = $this->_callFuncLog[$originMethod];
        } else {
            $method = 'action' . ucfirst($originMethod);
            $this->_callFuncLog[$originMethod] = $method;
        }
        if (method_exists($this, $method)) {
            //$this->beginCall($originMethod, $arguments);
            $return = call_user_func_array([$this, $method], $arguments);
            //$this->endCall($originMethod, $arguments);

            return $return;
        } else {

            throw new InvalidCallException('fecshop service method is not exit. ' . get_class($this) . "::$method");
        }


    }


    /**
     * 得到services里面配置的子服务childService的实例
     * @param $childServiceName
     */
    public function getChildService($childServiceName)
    {
        if (!isset($this->_childService[$childServiceName]) || !$this->_childService[$childServiceName]) {
            $childService = $this->childService;
            if (isset($childService[$childServiceName])) {
                 $service = $childService[$childServiceName];
                 if (!isset($service['enableService']) || $service['enableService'] !== false) {
                     $this->_childService[$childServiceName] = Yii::createObject($service);
                 } else {
                     throw new InvalidConfigException('Child Service[' . '] is disable in ' . get_called_class() . ', you must config it! ');
                 }
            } else {
                throw new InvalidConfigException('Child Service[' . $childServiceName . '] is not find in ' . get_called_class() . ', you must config it! ');
            }
        }

        return isset($this->_childService[$childServiceName]) ? $this->_childService[$childServiceName] : null;
    }

    /**
     * 如果开启service log，则记录开始的时间。
     * @param $originMethod
     * @param array $arguments
     */
    public function beginCall($originMethod, array $arguments)
    {
        if (Yii::$app->serviceLog->isServiceLogEnable()) {
            $this->_beginCallTime = microtime(true);
        }
    }

    /**
     * 调用service后，调用endCall，目前用来记录log信息
     * 1. 如果service本身的调用，则不会记录，只会记录外部函数调用service
     * 2. 同一次访问的service_uid 的值是一样的，这样可以把一次访问调用的serice找出来。
     * @param $originMethod and $arguments,魔术方法传递的参数
     * @param $arguments
     */
    public function endCall($originMethod, $arguments)
    {
        if (Yii::$app->serviceLog->isServiceLogEnable()) {
            list($logTrac, $isCalledByThis) = $this->debugBackTrace();
        }
    }


}