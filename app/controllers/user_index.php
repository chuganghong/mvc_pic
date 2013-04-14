<?php
//require_once("header.html");

//require_once("userMenu.php");
$which = $_GET["which"];
//var_dump($which);    //test

switch( $which )
{
	case "mailBox":     //收信箱
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 5;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$userId = $_SESSION["userId"];
		$this->UserModel->getMyMails($userId);     //获取我的收到的信件的总数量;
		//$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$nums = $this->UserModel->db->getRow();   //获取follows的总数
		$num = $nums["rows"];
		//$friendSrc = $_SESSION["userId"];
		//$rows_user = $rows_array["rows"];    //用户总数
		$pages = ceil($num/$length);    //可以显示的页数
		
		$receiverId = $_SESSION["userId"];
		$this->UserModel->ListMails($receiverId);                  //显示收件箱内的信件
		include("mailBox.php");
		break;
	case "mailto":      //显示发私信的表单
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 10;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$friendSrc = $_SESSION["userId"];
		$this->UserModel->getMyFollows($friendSrc);//查询我关注的用户总数
		
		$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$num = $this->UserModel->db->getSelectNum();   //获取follows的总数
		//$friendSrc = $_SESSION["userId"];
		//$rows_user = $rows_array["rows"];    //用户总数
		$pages = ceil($num/$length);    //可以显示的页数
		
		//$row = admin::getListPics($startId,$length);
		$this->UserModel->ListFollows($startId,$length,$friendSrc);
		require_once("mailto_form.php");
		break;
	case "firstPage":     //显示我关注的人发布的内容
		//echo "hello<br />";//test
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 5;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$userId = $_SESSION["userId"];
		$this->UserModel->getMyFirstPage($userId);////获取我关注的人的日志
		//$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$nums = $this->UserModel->db->getRow();   //获取follows的总数
		$num = $nums["rows"];
		var_dump($num);    //test
		//$friendSrc = $_SESSION["userId"];
		//$rows_user = $rows_array["rows"];    //用户总数
		$pages = ceil($num/$length);    //可以显示的页数
		var_dump($pages);   //test
		
		//$row = admin::getListPics($startId,$length);
		//$this->UserModel->ListMyPost($startId,$length,$userId);    //获取我关注的人的日志
		$this->UserModel->ListMyFirstPage($startId,$length,$userId);    //获取我关注的人的日志
		require_once("firstPage_user.php");
		break;
	case "myPost":      //显示我的日志
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 5;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$userId = $_SESSION["userId"];
		$this->UserModel->getMyPost($userId);//查询我的日志总数
		//$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$nums = $this->UserModel->db->getRow();   //获取日志的总数
		$num = $nums["rows"];
		//$friendSrc = $_SESSION["userId"];
		//$rows_user = $rows_array["rows"];    //用户总数
		$pages = ceil($num/$length);    //可以显示的页数
		
		//$row = admin::getListPics($startId,$length);
		$this->UserModel->ListMyPost($startId,$length,$userId);
		require_once("myPost.php");
		break;
	case "post":
		require_once("post_form.php");
		break;
	case "addFriend":
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 5;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
			//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$this->UserModel->getAllUsers();//查询注册用户总数
		//$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$nums = $this->UserModel->getRow();    //使用接口interface getRow
		$num = $nums["rows"];    //用户总数
		$pages = ceil($num/$length);    //可以显示的页数
		
			//$row = admin::getListPics($startId,$length);
		$this->UserModel->ListUsers($startId,$length);
			//$row = $this->PictureModel->getPictures();
			//$row = $this->getListPics($startId,$length);
		//$className = __CLASS__;
		require_once("ListUser.php");
		break;
	case "myFlows":
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 5;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$friendSrc = $_SESSION["userId"];
		$this->UserModel->getMyFollows($friendSrc);//查询我关注的用户总数
		//$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$num = $this->UserModel->db->getSelectNum();   //获取follows的总数
		var_dump($num);    //test
		//$friendSrc = $_SESSION["userId"];
		//$rows_user = $rows_array["rows"];    //用户总数
		$pages = ceil($num/$length);    //可以显示的页数
		var_dump($pages);//test
		
		//$row = admin::getListPics($startId,$length);
		$this->UserModel->ListFollows($startId,$length,$friendSrc);
		//$row = $this->PictureModel->getPictures();
		//$row = $this->getListPics($startId,$length);
		require_once("ListMyFlows.php");
		break;
	case "myFans":
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 5;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$friendDesc = $_SESSION["userId"];
		$this->UserModel->getMyFans($friendDesc);//查询我的粉丝总数
		//$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$num = $this->UserModel->db->getSelectNum();   //获取follows的总数
		//$friendSrc = $_SESSION["userId"];
		//$rows_user = $rows_array["rows"];    //用户总数
		$pages = ceil($num/$length);    //可以显示的页数
		
		//$row = admin::getListPics($startId,$length);
		$this->UserModel->ListFans($startId,$length,$friendDesc);
		//$row = $this->PictureModel->getPictures();
		//$row = $this->getListPics($startId,$length);
		require_once("ListMyFans.php");
		break;
		
}


//require_once("footer.html");