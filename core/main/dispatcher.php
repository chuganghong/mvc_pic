<?php
class dispatcher
{
    static function dispatch($router)
	{
	    global $app;
		ob_start();
		$start = microtime(true);
		$controller = $router->getController();
		$action = $router->getAction();
		$params = $router->getParams();
		$controllerfile = "app/controllers/{$controller}.php";
		if( file_exists($controllerfile) )
		{
		    require_once($controllerfile);
			$app = new $controller();
			$app->setParams($params);   //类方法
			$app->$action();
			if( isset($start) )
			{
			    $time = microtime(true)-$start;
				echo "Totall time for dispatching is: " . $time . " seconds.";
			}
			$output = ob_get_clean();
			echo $output;
		}
		else
		{
		    throw new Exception("Controller not found<br />");
		}
	}
}