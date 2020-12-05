<?php

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
/**
 * @zhangjinyu
 * 增加services层
 */
Yii::setAlias('@services', dirname(dirname(__DIR__)) . '/services');

/**
 * @zhangjinyu
 * 增加api接口
 */
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');