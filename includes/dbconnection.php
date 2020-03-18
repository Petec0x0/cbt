<?php

define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://127.0.0.1/cbt');
$server = $_SERVER["HTTP_HOST"];

$server_name = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cbt";

$conn = mysqli_connect($server_name, $dbUsername, $dbPassword, $dbName);