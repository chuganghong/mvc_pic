<?php
require("core/main/ini.php");
$bool = session_start();  //开启会话
var_dump($bool);    //test
//echo 'start<br />';//test

$initializer = new initializer();

$router = loader::load("router");
//var_dump($router);  //test

dispatcher::dispatch($router);


