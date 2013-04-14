<?php
class AdminModel extends model
{	
	
	function ListAdmin($username,$password)  //发送查询一个用户信息的SQL语句
	{
		$sql = "SELECT * FROM admin WHERE adName='$username' AND adPwd='$password'";
		$this->db->query($sql);
	}
	
	function InsertAdmin($username,$password)   //插入用户信息
	{
		$sql = "INSERT INTO admin (adName,adPwd) VALUES ( '$username','$password' )";
		$this->db->query($sql);
	}
	
	function getUserNum($num)   //
	{
		//$num = $this->db->getSelectNum();
		if( $num > 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function register($username,$password)   //处理注册请求
	{
		$username = $this->f_input($username);
		$password = $this->f_input($password);
		
		$this->InsertAdmin($username,$password);
		$num = $this->db->getAffectedNum();
		if( $this->getUserNum($num) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function login($username,$password)     //处理登录请求
	{
		$username = $this->f_input($username);
		$password = $this->f_input($password);
		
		$this->ListAdmin($username,$password);
		$num = $this->db->getSelectNum();
		if( $this->getUserNum($num) )
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	
	
}