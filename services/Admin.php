<?php


namespace services;


use services\Service;

/**
 * @property admin\Menu $menu
 * @property-read int $id
 */
class Admin extends Service
{
    public function init()
    {
        echo "初始化admin" . PHP_EOL;
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function getId() {
        return 8;
    }

}