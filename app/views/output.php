<?php
/*
 * 输出函数
 */

//输出菜单
function show_menu($array_menu)
{
	echo "<table border=\"1\" width=\"80%\" align=\"center\">";
	echo "<tr align=\"center\">";
	foreach( $array_menu as $url=>$menu )
	{	
		echo "<td><a href=\"" . $url . "\">" . $menu . "</a></td>";
	}
	echo "</tr>";	
	echo "</table>";
}