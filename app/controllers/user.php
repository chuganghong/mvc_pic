<?php

/**
 * {0}
 * 
 * @author:cg
 * @version :20130320
 * @time : 2013年4月03日11点05分
 */
class user extends controller
{
	public $AdminModel;
	public $PictureModel;
	public $AlbumModel;
	public $TopicModel;
	public $UserModel;
	
	function __construct()
	{
		$this->AdminModel = new AdminModel();
		$this->PictureModel = new PictureModel();
		$this->AlbumModel = new AlbumModel();
		$this->TopicModel = new TopicModel();
		$this->UserModel = new UserModel();
	}
	
	function mailto()    //发送私信
	{
		$senderId = $_SESSION["userId"];    //发送私信的人的ID
		$receiverId = $_POST["receiverId"];     //收私信的人的ID
		$content = $_POST["mailContent"];       //私信内容
		require_once("mailto.php");      //处理发信
	}
	function spliceFriends()   //批量取消关注
	{
		$friendSrc = $_SESSION["userId"];    //执行“取消关注”这个操作的用户的ID
		$friendDescs = $_POST["userId"];    //要被取消关注的用户的ID，是一个数组
		require_once("spliceFriends.php");
	}
	
	function spliceFriend()     //取消对一个用户的关注
	{
		$friendSrc = $_SESSION["userId"];     //执行“取消关注”这个操作的用户的ID
		$friendDesc = $_GET["userId"];    //要被取消关注的用户的ID
		require_once("spliceFriend.php");
	}
	
	function addFriends()    //批量关注
	{
		require_once("addFriends.php");
	}
	
	function addFriend()     //关注一个用户
	{
		$friendSrc = $_SESSION["userId"];
		$friendDesc = $_GET["userId"];
		require_once("addFriend.php");
	}
	
	function deleteMyPosts()    //批量删除日志
	{
		$contentIds = $_POST["contentId"];    //要删除的日志的ID
		require_once("deleteMyPosts.php");
		
	}
	
	function deleteMyPost()     //删除一篇日志
	{
		$contentId = $_GET["contentId"];
		//$this->UserModel->deleteMyPost($contentId);     //删除我的日志
		require_once("deleteMyPost.php");
	}
	
	/*移到parent类
	function login()	
	{
		$controller = __CLASS__;
		include("login.php");		
	}
	*/
	function logout()
	{
		$this->UserModel->logout($_SESSION["username"]);
		$url = $_SERVER["SCRIPT_NAME"] . "?user/login";
		include("login_form.php");
	}
	
	function post()   //发表内容
	{
		$userId = $_SESSION["userId"];
		$content = $_POST["content"];     //接收用户发表的内容
		require_once("userPost.php");
	}
	
	function register()
	{
		$controller = __CLASS__;   //本类名
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
		$url = $_SERVER["SCRIPT_NAME"] . "?user/register";
		include("register_form.php");
	}
	
	function user_index()
	{
		if( $this->UserModel->isLogin($_SESSION["username"]) )
		{
			require_once("header.html");
			
			require_once("userMenu.php");
			
			//var_dump($_SESSION["username"]);  //test
		    //var_dump($_SESSION["userId"]);    //test
		    $className = __CLASS__;//在此处可以获得类名，在user_index.php中为何不能获得类名？
		    
			include("user_index.php");
			
			require_once("footer.html");
		}
		else
		{
			include("login_form.php");
		}
	}
	
	function base()
	{
		$url = $_SERVER["SCRIPT_NAME"] . "?user/login";
		include("login_form.php");
	}
	
	function setParams($params)
	{
		//var_dump($params);
	}
}
	