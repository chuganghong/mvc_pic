<?php
class router
{
    private $route;
	private $controller;
	private $action;
	private $params;
	
	function __construct()
	{
	    $path = array_keys($_GET);
		if( !isset($path[0]) )
		{
		    if( !empty($default_controller) )
			{
			    $path[0] = $default_controller;
			}
			else
			{
			    $path[0] = "index";
			}
		}
		$route = $path[0];
		//var_dump($route);  //test
		$this->route = $route;
		//$routeParts = @split("/",$route);
		$routeParts = explode("/",$route);
		$this->controller = $routeParts[0];
		$this->action = isset($routeParts[1])?$routeParts[1]:"base";
		array_shift($routeParts);
		array_shift($routeParts);
		$this->params = $routeParts;
	}
	
	function getAction()
	{
	    if( empty($this->action) )  //怎么会为空？构造函数里面不是赋值了吗？
		{
		    //$this->action = "main";
		    $this->action = "base";
		}
		return $this->action;
	}
	
	function getController()
	{
	    return $this->controller;
	}
	
	function getParams()
	{
	    return $this->params;
	}
}