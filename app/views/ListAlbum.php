<?php 
$array_th = array(
		"图集ID",
		"图集标题",
		"所属栏目",
		"操作"
);
$pre_1 = $_SERVER["SCRIPT_NAME"]. "?admin/showAlbum&albumId=";
$pre_2 = $_SERVER["SCRIPT_NAME"] . "?admin/uploadImage_form&albumId=";
$operation = array(
		$pre_1=>"查看图集",
		$pre_2=>"上传图片"
);
$object = $this->AlbumModel;
$table = "listAlbumTable";
$url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListAlbum";
$action = $_SERVER["SCRIPT_NAME"] . "?admin/deleteAlbum";
$method="post";
$submitValue = "删除";
$tableList = new tableList($array_th,$operation,$object,$table,$url,$action,$method,$submitValue,$pages);
$tableList->show_list();















/*
$array_th = array(
		"图集ID",
		"图集标题",
		"所属栏目",
		"操作"
);
$pre_1 = $_SERVER["SCRIPT_NAME"]. "?admin/showAlbum&albumId=";
$pre_2 = $_SERVER["SCRIPT_NAME"] . "?admin/uploadImage_form&albumId=";
$operation = array(
		$pre_1=>"查看图集",
		$pre_2=>"上传图片"
);
$object = $this->AlbumModel;
$table = new listAlbumTable($array_th,$operation,$object);
//$table->show_table();
//分页
$url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListAlbum";
$page = new page($url,$pages);

$action = $_SERVER["SCRIPT_NAME"] . "?admin/deleteAlbum";
$method="post";
$submitValue = "删除";
$content = array($table,$page);
$form = new form($action,$method,$submitValue,$other="",$content);
*/
