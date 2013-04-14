<?php
require_once("output.php");
$pre = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=";
$array_menu = array(
	$pre . "addTopic"=>"新建栏目",
	$pre . "addAlbum"=>"新建图集",
	$pre . "ListAlbum"=>"图集列表",
	$pre . "ListPicture"=>"图片列表",
	$pre . "ListUser"=>"用户列表",
	$_SERVER["SCRIPT_NAME"] . "?admin/logout"=>"退出登录"
);

show_menu($array_menu);
