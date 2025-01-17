<?php
define("APP_ROOT", dirname(__FILE__, 2));
require APP_ROOT . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(APP_ROOT . '/src');
$dotenv->load();

require APP_ROOT . '/config/config.php';

if (DEV === false) {
    set_exception_handler('exception_handler');
    set_error_handler('error_handler');
    register_shutdown_function('shutdown_handler');
}

$cms = new \Core\CMS($dsn, $db_user, $db_password);
unset($dsn, $db_user, $db_password);