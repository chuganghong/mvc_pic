<?php
interface getRow      //
{
	function getRow();     //获取数据库查询结果集中的一行
}
class model implements getRow    //继承model类的类是否也继承了此接口？
{
	public $db;   //数据库操作类
	
	function __construct()
	{
		$this->db = new db("localhost","root","","picture");
	}
	
	function getRow()     //实现接口
	{
		$row = $this->db->getRow();
		//$num = @$row["rows"];
		return $row;
	}
	
	function f_input($input)  //过滤数据
	{
		$output = trim($input);
		$output = mysql_real_escape_string($output);
		return $output;
	}
	
	function deleteFile($dir_1,$dir_2)      //删除服务器上的文件。要防止删除一些文件夹
	{//$path_1和$path_2是相等的，都是你要删除的文件。此函数不能删除以开始就是空目录的文件。
		$dir_array = glob($dir_1 . "/*");
		foreach( $dir_array as $file )
		{
			if( is_dir($file) )
			{
				//deleteFile($file . "/*",$dir_2);//错误
				deleteFile($file,$dir_2);
			}
			else
			{
				unlink( $file );
			}
		}
		if( $dir_1 !== $dir_2 )
		{
			rmdir($dir_1);
		}		
	}
	
	function isLogin($session)   //检测是否登录
	{
		if( isset($session) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function logout($session)   //退出登录
	{
		unset($session);
		session_destroy();
	}
	
	
}