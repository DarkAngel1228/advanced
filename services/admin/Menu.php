<?php

namespace services\admin;

use services\Service;

class Menu extends Service
{
    /**
     * @var array 后台菜单配置
     */
    public $menuConfig;

    public function getMenu() {
        echo '我是菜单';
    }
}