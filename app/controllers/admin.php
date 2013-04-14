<?php

/**
 * {0}
 * 
 * @author:cg
 * @version :20130320
 * @time : 2013年3月20日5点53分
 */
class admin extends controller
{
	public $AdminModel;
	public $PictureModel;
	public $AlbumModel;
	public $TopicModel;
	public $UserModel;
	public $db;
	
	function __construct()
	{
		$this->AdminModel = new AdminModel();
		$this->PictureModel = new PictureModel();
		$this->AlbumModel = new AlbumModel();
		$this->TopicModel = new TopicModel();
		$this->UserModel = new UserModel();
		$this->db = $this->UserModel->db;
	}
	
	function addTopic()   //处理新建栏目操作，该不该设置参数？
	{
		$topicName = $_POST["topicName"];
		if( $this->TopicModel->TopicExists($topicName) )   //不允许新增栏目与已存在栏目同名
		{
			//echo "<script>alert(\"已经存在该栏目\");</script>";   //是否该将其移动到view？
			//Fatal error: Cannot break/continue 1
			echo "<script>alert(\"已经存在该栏目\");history.go(-1);</script>";
			//break;   //此处用break好像有问题，为什么？
		}
		else
		{	
		    $num = $this->TopicModel->InsertTopic($topicName);
		    if( $num )//增加栏目成功
		    {
			//包含试图，
			     include("addTopic_sucess.php");
		    }
		    else
		    {
			     include("addTopic_failed.php");
		    }
		}
	}
	
	function addAlbum()      //处理创建图集操作
	{
		$topicId = $_POST["topicId"];     //栏目ID
		$albumName = $_POST["albumName"];      //图集标题
		include("addAlbum.php");      //处理图片，具体是缩略图上传，属Model
		require("header.html");
		require("menu.php");
		switch($result)
		{
			case 1:
				
				echo "Not a picture.<br />";
				break;
			case 2:
				echo "To big.<br />";
				break;
			case 3:
				echo "Sucess.<br />";
				break;
			case 4:
				echo "Upload failed.<br />";
				break;
			case 5:
				echo "Save information of miniature failed.<br />";
				break;
			case 6:
				echo "Save information of album failed.<br />";
				break;
		}
		require("footer.html");
	}
	
	function uploadImage()   //处理上传图片操作
	{
		require("menu.php");
		$albumId = $_GET["albumId"];    //获取图集ID
		require("uploadImage.php");     //属于Model
		switch($result)
		{
			case 1:
				echo "文件不是图片。<br />";
				break;
			case 2:
				echo "文件太大了。<br />";
				break;
			case 3 :
				echo "上传成功。<br />";
				break;
			case 4 :
				echo "上传失败。<br />";
				break;
			case 5 :
				echo "图片信息成功存入数据库。图片上传成功。<br />";
				break;
			case 6 :
				echo "图片信息未能存入数据库。<br />";
				break;
		}
	}
	
	function deletePicture()
	{
		$picId_url = $_POST["picId_url"];     //二维数组，图片ID和url值对，形如id->url
		require("deletePicture.php");     //删除图片
	}
	
	function deleteUser()
	{
		$userId = $_POST["userId"];    //数组
		require("deleteUser.php");
	}
	
	//处理删除图集操作
	function deleteAlbum()
	{
		//$thumbId = $_POST["thumbId"];     //是一个二维数组，缩略图的图片ID
		
		isset($_POST["album_thumb"])?($album_thumb = $_POST["album_thumb"]):"";     //图集ID和缩略图ID的组合值
		require("header.html");
		require("menu.php");
		require("deleteAlbum.php");    //删除图集
		/*
		switch($result)     //太长了，有必要弄这么长吗？调试时很好，但正式代码这样不好吧？但这是对错误处理的结果啊。求解决办法。
		{
			case 1 :
				echo "删除缩略图成功。<br />";
				break;
			case 2 :
				echo "删除缩略图失败。<br />";
			case 3 :
				echo "删除缩略图数据库信息成功。<br />";
				break;
			case 4 :
				echo "删除缩略图数据库信息失败。<br />";
				break;
			case 5 :
				//echo "删除其他图片的数据库信息成功。<br /";
				echo "删除其他图片成功。<br /";
				break;
			case 6 :
				echo "删除其他图片失败。<br />";
				break;
			case 7 :
				echo "删除其他图片的数据库信息成功。<br />";
				break;
			case 8 :
				echo "删除其他图片数据库信息失败。<br /";
				break;
			case 9 :
				echo "删除图集数据库信息成功。删除图集成功。<br />";
				break;
			case 10 :
				echo "删除图集数据库信息失败。<br />";
				break;
		}
		*/
		require("footer.html");
	}
	
	function showAlbum()  //显示一个图集的图片
	{
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		//$startId = 0;
		$length = 20;    //设置一页显示多少张图片
		$startId = $length*($_GET["cpage"]-1);
		$albumId = $_GET["albumId"];     //图集ID
		$this->PictureModel->ListPictures_album($startId,$length,$albumId);   //获取一个图集的一区间段的图片信息;  
		//$row_pic = this->PictureModel->getPicture();   //获取一张图片的信息数组
		
		$this->AlbumModel->getPicOfAlbum($albumId);      //获取一个图集的图片数量
		$rows = $this->AlbumModel->getalbums();   //获取一个图集的信息数组
		$rows_num = $rows["rows"];    //一个图集的所有图片数量
		$pages = ceil($rows_num/$length);     //可以分成多少页
		
		require("header.html");
		require("menu.php");     //显示菜单
		require("showAlbum.php");     //显示一个图集的图片
		require("footer.html");
		
	}
	/*移动parent类。移动到parent类后，__CLASS__就是父类名了
	function login()	
	{
		$controller = __CLASS__;
		include("login.php");		
	}
	*/
	function logout()
	{
		$this->AdminModel->logout($_SESSION["username"]);
		//$controller = "admin";
		$url = $_SERVER["SCRIPT_NAME"] . "?admin/login";
		include("login_form.php");
	}
	
	function register()
	{
		$controller = __CLASS__;     //本类名
		include("register.php");
	}
	
	function uploadImage_form()   //上传图片的表单
	{
		include("uploadImage_form.php");
	}
	/*
	function login_form()
	{
		//echo 'login<br />';//test
		include("login_form.php");
	}
	*/
	function register_form()
	{
		$url = "/mvc_pic/index.php?admin/register";
		include("register_form.php");
	}
	
	function admin_index()
	{
		if( $this->AdminModel->isLogin($_SESSION["adminname"]) )
		{
			require("header.html");
			require("menu.php");
			var_dump($_SESSION["adminname"]);  //test
		    $className = __CLASS__;//在ListUser.php中需要/在此处可以获得类名，在admin_index.php中为何不能获得类名？
			include("admin_index.php");
			require("footer.html");
		}
		else
		{
			include("login_form.php");
		}
	}
	
	 function getListPics($startId,$length)  //获取图片信息
	{
		//$this->PictureModel->ListPictures($startId,$length);
		include("admin_index.php");
		//$row = $this->PictureModel->getPictures($startId,$length);
		//$row = $this->PictureModel->getPictures();
		//return $row;
	}
	
	function base()
	{
		$url = $_SERVER["SCRIPT_NAME"] . "?admin/login";
		include("login_form.php");
	}
	
	function setParams($params)
	{
		//var_dump($params);
	}
}
