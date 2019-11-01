<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

// DB connect
$mysqli = new mysqli('192.168.0.100', 'root', 'T0o31qws2u5R', 'beejee');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}

$controller = 'controllers\Tasks';
$action = 'index';

if (isset($_REQUEST['r']) && !empty($_REQUEST['r'])) {
    $r = explode('-', $_REQUEST['r']);
    $controller = 'controllers\\' . ucfirst(trim($r[0]));
    $action = trim($r[1]);
}

session_start();

$tasks = new $controller();
$tasks->$action();

// destroy
$mysqli->close();
