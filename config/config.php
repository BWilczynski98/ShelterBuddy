<?php
define("DEV", true);

$directory_path = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']));
$parent_directory_path = dirname($directory_path);
define('DOC_ROOT', $parent_directory_path . '/public/');

$db_type = $_ENV['DB_TYPE'];
$db_server = $_ENV['DB_SERVER'];
$db_name = $_ENV['DB_NAME'];
$db_port = $_ENV['DB_PORT'];
$db_charset = $_ENV['DB_CHARSET'];
$db_user = $_ENV['DB_USER'];
$db_password = $_ENV['DB_PASSWORD'];

$dsn = "$db_type:host=$db_server;dbname=$db_name;port=$db_port;charset=$db_charset";