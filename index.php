<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

define('BASE_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('CONF_DIR', BASE_ROOT . 'config');
define("LOG_DIR", BASE_ROOT . "cached" . DIRECTORY_SEPARATOR);

require_once BASE_ROOT . 'autoloader.php';
spl_autoload_register('AutoLoader::autoload'); // 注册自动加载

(new \app\Application())->run();
