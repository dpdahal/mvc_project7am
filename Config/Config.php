<?php
ob_start();
session_start();

if ($_SERVER['HTTP_HOST'] === "localhost") {
    $env = "development";
    $httpHost = $_SERVER['SERVER_NAME'];

} else {
    $env = "production";
}

switch ($env) {
    case "development":
        error_reporting(-1);
        define('ROOT', dirname(dirname(__DIR__)) . '/project7am/');
        define('BASE_URL', 'http://' . $httpHost . '/project7am/');
        define('AdminPath', 'http://' . $httpHost . '/project7am/Admin/');

        break;

    case "production":

        break;

}

$GLOBALS['configs'] = [
    'database' => [
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '',
        'dbname' => 'project7am'
    ]

];