<?php
require_once("output.php");
$pre = $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=";
$array_menu = array(
	$pre . "firstPage"=>"首页",
	$pre . "mailto"=>"发私信",
	$pre . "mailBox"=>"收件箱",
	$pre . "myPost"=>"我的日志",
	$pre . "addFriend"=>"增加朋友",
	$pre . "post"=>"发表日志",
	$pre . "myFlows"=>"我关注的人",
	$pre . "myFans"=>"我的粉丝",
	"#"=>"我的资料",
	$_SERVER["SCRIPT_NAME"] . "?user/logout"=>"退出登录"
);
show_menu($array_menu);

