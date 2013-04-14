<?php
/*
 * 类，显示图集列表之类的项目。
 * 我看不出这个类有何优点。
 */
class tableList
{
	protected $array_th;     //表头
	protected $operation;    //文字操作信息，比如“删除”
	protected $object;
	protected $table;        //表格类
	protected $url;
	protected $pages;    //总页数，分页符中需要
	protected $action;
	protected $method;
	protected $submitValue;
	protected $other="";      //表单的其他属性，比如：enctype="multipart/form-data"
	
	function __construct($array_th,$operation,$object,$table,$url,$action,$method,$submitValue,$pages)
	{
		$this->array_th = $array_th;
		$this->operation = $operation;
		$this->object = $object;
		$this->table = $table;
		$this->url = $url;
		$this->action = $action;
		$this->method = $method;
		$this->submitValue = $submitValue;
		$this->pages = $pages;
	}
	
	function show_list()
	{
		$table = new $this->table($this->array_th,$this->operation,$this->object);
		$page = new page($this->url,$this->pages);//利用interface，此处的table和page样式可以很容易更换//原来已经在form类中使用display接口了
		$content = array($table,$page);
		$form = new form($this->action,$this->method,$this->submitValue,$this->other,$content);
	}
}















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