<?php 
//require("header.html");
//require("menu.php");
$which = @$_GET["which"];
var_dump($_SERVER["SCRIPT_NAME"]);
switch($which)
{
	case "addTopic":   //新建栏目
		include("addTopic_form.php");
		break;
	case "addAlbum" :     //新建图集
		$this->TopicModel->AllTopic();   //调用TopicModel类的方法获取所有栏目信息
		//$row = $this->TopicModel->db->getRow();     //获取这个结果集中的一行，一个关联数组或其他
		include("addAlbum_form.php");
		break;
	case "ListAlbum" :     //图集列表
		//$startId = 0;
		//获取总记录数
		$this->AlbumModel->getAllAlbums();     //获取所有图集的记录数
		$row = $this->AlbumModel->getalbums();    //从查询结果集中获取数据
		$rows = $row["rows"];     //为图集的总记录数
		var_dump($rows);     //test
		
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"]=1;
		}	
		//$startId = 1;	
		//$startId = $_GET["cpage"];//错误
		$length = 5;      //设置显示图集的数量
		$startId = $length*($_GET["cpage"]-1);
		
		$pages = ceil($rows/$length);      //总页数
		var_dump($pages);      //test
		var_dump($startId);    //test
		$this->AlbumModel->ListAlbums($startId,$length);
		include("ListAlbum.php");
		break;
	case "ListPicture" :    //图片列表
		//echo 'start<br />';//test
		//$startId = 0;
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 4;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$this->PictureModel->getAllPictures();//查询图片总数
		$rows_array = $this->PictureModel->getPicture();   //获取一张图片的信息数组
		$rows_pic = $rows_array["rows"];    //图片总数
		$pages = ceil($rows_pic/$length);    //可以显示的页数
		
		//$row = admin::getListPics($startId,$length);
		$this->PictureModel->ListPictures($startId,$length);
		//$row = $this->PictureModel->getPictures();
		//$row = $this->getListPics($startId,$length);
		include("ListPicture.php");
		break;	
	case "ListUser" :       //用户列表
		if( !isset($_GET["cpage"]) )
		{
			$_GET["cpage"] = 1;
		}
		$length = 5;     //设定一页显示多少，有必要把这个移到可视界面设置，在代码中改动不好。
		$startId = $length*($_GET["cpage"]-1);
		//$length = 20;     //设定一页显示多少页，有必要把这个移到可视界面设置，在代码中改动不好。
		
		$this->UserModel->getAllUsers();//查询注册用户总数
		$rows_array = $this->UserModel->getUser();   //获取一注册用户的信息数组
		$rows_user = $rows_array["rows"];    //用户总数
		$pages = ceil($rows_user/$length);    //可以显示的页数
		
		//$row = admin::getListPics($startId,$length);
		$this->UserModel->ListUsers($startId,$length);
		//$row = $this->PictureModel->getPictures();
		//$row = $this->getListPics($startId,$length);
		//$className = __CLASS__;
		include("ListUser.php");
		break;
}

//require("footer.html");