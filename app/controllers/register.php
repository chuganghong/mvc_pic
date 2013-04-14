<?php
$username = $_POST["username"];
$password = $_POST["password"];

switch($controller)
{
	case "admin" :		
		if( $this->AdminModel->register($username,$password) )
		{
		//注册成功
			$_SESSION["username"] = $username;
			Header("Location:" . $_SERVER["SCRIPT_NAME"] . "?admin/admin_index");
		}
		else
		{
		//注册失败
		}
		break;
	case "user" :
		if( $this->UserModel->register($username,$password) )
		{
			//注册成功
			$_SESSION["username"] = $username;
		}
		else
		{
			//注册失败
		}
		break;
}