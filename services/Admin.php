<?php


namespace services;


use services\Service;

/**
 *
 * @property-read int $id
 */
class Admin extends Service
{
    public function __construct($config = [])
    {
        echo "初始化admin" . PHP_EOL;
    }

    public function getId() {
        return 8;
    }
}