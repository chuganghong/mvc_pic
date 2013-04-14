<?php
//session_start();   //在首页开启后似乎无效//Notice: A session had already been started - ignoring session_start()
$username = $_POST["username"];
$password = $_POST["password"];
//var_dump($username);   //test

switch($controller)
{
	case "admin" :
		if( $this->AdminModel->login($username,$password) )
		{
			//echo 'start<br />';//test
			$_SESSION["adminname"] = $username;   //此处应该用经过滤后的数据吗？但在这个文件里不容易获得过滤后的数据
			$_SESSION["adminPwd"] = $password;    //有必要存储两个吗？
			//重定向到
			//var_dump($_SESSION["username"]);   //test
			Header("Location:/mvc_pic/index.php?admin/admin_index");
		}
		else
		{
			echo "Hello<br />";//test
			Header("Location:/mvc_pic/index.php?admin");//此处的URUL要想办法用变量替换
		}
		break;
	case "user" :
		if( $this->UserModel->login($username,$password) )
		{
			//echo 'start<br />';//test
			$_SESSION["username"] = $username;   //此处应该用经过滤后的数据吗？但在这个文件里不容易获得过滤后的数据
			$_SESSION["password"] = $password;    //有必要存储两个吗？
			$_SESSION["userId"] = $this->UserModel->getUserId();
			//var_dump($_SESSION["userId"]);       //test
			//重定向到
			//var_dump($_SESSION["username"]);   //test
			//echo "user成功登录。<br />";     //test
			//Header("Location:/mvc_pic/index.php?admin/admin_index");
			Header("Location:" . $_SERVER["SCRIPT_NAME"] . "?user/user_index");
		}
		else
		{
			echo "user登录失败<br />";//test
			//Header("Location:/mvc_pic/index.php?admin");//此处的URUL要想办法用变量替换
		}
}
