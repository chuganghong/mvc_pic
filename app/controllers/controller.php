<?php
abstract class controller
{
	function login()
	{
		$key_array = array_keys($_GET);   //结果是数组
		$key_string = $key_array[0];		
		$key_arr = explode("/",$key_string);		
		$controller = $key_arr[0];

		//上面的代码对URL的查询部分进行了解析，在dispather中已经实现了此功能，此处出现了重复代码
		include("login.php");
	}
}