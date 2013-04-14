<?php
class initializer
{
	function __construct()
	{
	   set_include_path( get_include_path() . PATH_SEPARATOR . "core/main" );
	   set_include_path( get_include_path() . PATH_SEPARATOR . "app/models" );
	   set_include_path( get_include_path() . PATH_SEPARATOR . "app/views" );
	   set_include_path( ini_get("include_path") . PATH_SEPARATOR . "app/controllers" );
	   //$db = new db("localhost","root","","picture");
	}
}