<?php

class index
{
    function __construct()
    {
        //echo "Hello";
    	//session_start();
    }
    
    function setParams($params)
    {
       //var_dump($params);
    }

    function base()
    {
        // var_dump($db);
		// echo $_SERVER["REQUEST_URI"] . "<BR />";
		// $url = $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"];
		 //echo "<a href=\"" ."index.php?" . "user/login_form\">login</a>";
		 require("login_form.php");
    }
}
?>