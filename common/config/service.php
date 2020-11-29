<?php

// 服务层
$services = [];

foreach (glob(__DIR__ . '/services/*.php') as $filename) {
    $services = array_merge($services, require($filename));
}

return ['services' => $services];